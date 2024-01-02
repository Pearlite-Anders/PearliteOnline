<?php

namespace App\Livewire\WeldingCertificates;

use App\Models\File;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use setasign\FpdiPdfParser\PdfParser\PdfParser;

class Signer extends Component
{
    public $file;
    public $welding_certificate;
    public $open = false;
    public $date;
    public $class;
    private $pdf;
    private $temp_file;
    private $sizes;


    public function toggleOpen()
    {
        if(!$this->date) {
            $this->date = now()->format('Y-m-d');
        }

        $this->open = !$this->open;

        if($this->open) {
            $this->check_for_potential_errors();
        }
    }

    public function sign()
    {
        $this->pdf = new \setasign\Fpdi\Fpdi();
        $this->pdf->SetFont('Arial', '', '7');

        $this->temp_file = $this->file->temporary_download();
        $pageCount = $this->pdf->setSourceFileWithParserParams(
            $this->temp_file,
            [
                PdfParser::PARAM_IGNORE_PERMISSIONS => true
            ]
        );

        $data = $this->welding_certificate->data;
        $signature_boxes = optional($data)['signature_boxes'];
        if(empty($signature_boxes)) {
            return $this->addError('signature_boxes', __('No signature boxes found'));
        }

        usort($signature_boxes, function ($a, $b) {
            return $a['x'] <=> $b['x'];
        });

        $signed = optional($data)['signed'];
        if($signed >= optional($data)['max_signatures']) {
            return $this->addError('signature_boxes', __('Max signatures reached'));
        }

        if(preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->date)) {
            $date = Carbon::parse($this->date)->format('Y.m.d');
        } else {
            $date = $this->date;
        }

        $signature = null;
        if(auth()->user()->profile_photo_path) {
            $file = File::find(auth()->user()->profile_photo_path);
            $signature = $file->temporary_download();
        }

        if(!$signature) {
            return $this->addError('signature_boxes', __('No signature found'));
        }

        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            $this->addTemplate($pageNumber);
            $this->addBoxToPdf($signature_boxes, 'date', $date, $signed, $pageNumber);
            $this->addBoxToPdf($signature_boxes, 'title', optional(auth()->user()->data)['title'], $signed, $pageNumber);
            $this->addBoxToPdf($signature_boxes, 'signature', $signature, $signed, $pageNumber);
        }

        $file = File::newFromString(
            $this->pdf->Output('S'),
            $this->welding_certificate,
            $this->file->name,
        );

        $oldCertificates = $this->welding_certificate->previous_files;
        $oldCertificates[] = $this->welding_certificate->current_file_id;
        $this->welding_certificate->previous_files = $oldCertificates;

        $this->welding_certificate->current_file_id = $file->id;
        $data['signed'] = $signed + 1;
        $data['last_signature'] = Carbon::createFromFormat('Y.m.d', $date)->format('Y-m-d');
        $data['next_signature'] = Carbon::createFromFormat('Y.m.d', $date)->addMonths(6)->subDay()->format('Y-m-d');
        $this->welding_certificate->data = $data;
        $this->welding_certificate->save();
        $this->toggleOpen();

        $this->dispatch('welding-certificate-signed');
    }

    public function check_for_potential_errors()
    {
        $data = $this->welding_certificate->data;
        $signature_boxes = optional($data)['signature_boxes'];
        if(empty($signature_boxes)) {
            $this->addError('signature_boxes', __('No signature boxes found'));
        }

        $signed = optional($data)['signed'];
        if($signed >= optional($data)['max_signatures']) {
            $this->addError('signature_boxes', __('Max signatures reached'));
        }

        if(!auth()->user()->profile_photo_path) {
            $this->addError('signature_boxes', sprintf(__('No signature found on your profile, please upload one: <a href="%s" class="underline">Edit Profile</a>'), route('profile.show')));
        }

    }

    private function addTemplate($pageNumber = 1)
    {
        $this->pdf->setSourceFile($this->temp_file);
        $pageId = $this->pdf->importPage($pageNumber);
        $this->sizes = $this->pdf->getTemplateSize($pageId);
        $s = $this->pdf->getTemplatesize($pageId);
        $this->pdf->AddPage($s['orientation'], $s);
        $this->pdf->useTemplate($pageId);
    }

    public function addBoxToPdf($signature_boxes, $type, $value, $signed, $pageNumber)
    {
        $boxes = collect($signature_boxes)->filter(function ($box) use ($type) {
            return strpos($box['name'], $type) !== false;
        });

        foreach($boxes as $box) {
            $number_of_lines = str_replace($type . '-', '', $box['name']);

            if($signed >= $number_of_lines) {
                $signed -= $number_of_lines;
                continue;
            }

            if($box['page_number'] != $pageNumber) {
                continue;
            }

            $scaleX = $box['canvas_width'] / $this->sizes['width'];
            $scaleY = $box['canvas_height'] / $this->sizes['height'];
            $heightPerLine = ($box['height'] / $number_of_lines);
            $width = $box['width'] / $scaleX;

            $x = $box['x'] / $scaleX;
            $y = ($box['y'] + ($heightPerLine * $signed) + ($heightPerLine / 2)) / $scaleY;

            if($type == 'signature') {
                [$width1, $height1] = getimagesize($value);
                $width2 = $width;
                $height2 = $heightPerLine / $scaleY;
                if (($width1 / $width2) < ($height1 / $height2)) {
                    $width2 = 0;
                    $height2 -= 2;
                } else {
                    $height2 = 0;
                    $width2 -= 2;
                }

                $this->pdf->Image(
                    $value,
                    $x,
                    $y - ($heightPerLine / 4),
                    $width2,
                    $height2
                );

            } else {
                $this->pdf->text(
                    $x,
                    $y,
                    iconv('UTF-8', 'windows-1252', $value)
                );
            }

            break;
        }

    }

    public function render()
    {
        return view('livewire.welding-certificates.signer');
    }
}
