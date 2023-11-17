<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Component;

class Signer extends Component
{
    public $file;
    public $welding_certificate;
    public $open = false;
    public $date;
    private $pdf;
    private $temp_file;

    public function toggleOpen()
    {
        if(!$this->date) {
            $this->date = now()->format('Y-m-d');
        }

        $this->open = !$this->open;
    }

    public function sign()
    {
        $this->pdf = new \setasign\Fpdi\Fpdi();
        $this->pdf->SetFont('Arial', '', '7');

        $this->temp_file = $this->file->temporary_download();

        // if (! empty((array) $rectLocation)) {
        //     for ($pageNumber = 1; $pageNumber <= $rectLocation->pages; $pageNumber++) {
        //         $this->addTemplate($pageNumber);

        //         if ($rectLocation->page == $pageNumber) {
        //             $this->addDateFromCustomLocation($date, $rectLocation);
        //             $this->addSignatureFromCustomLocation($rectLocation);
        //             $this->addTitleFromCustomLocation($rectLocation);
        //         }
        //     }
        // }

        // $file = File::newFromString(
        //     $this->pdf->Output('S'),
        //     $this->weldingCertificate,
        //     '/certificates/'.uniqid('signed_pdf', true).'.pdf',
        // );

        // $oldCertificates = $this->weldingCertificate->previous_certificates;
        // $oldCertificates[] = $this->weldingCertificate->certificate;
        // $this->weldingCertificate->previous_certificates = $oldCertificates;

        // $this->weldingCertificate->certificate = $file->id;
        // $this->weldingCertificate->signed += 1;
        // $this->weldingCertificate->last_signature = Carbon::parse($date);
        // $this->weldingCertificate->next_signature = Carbon::parse($date)->addMonths(6)->subDay();
        // $this->weldingCertificate->save();

    }

    private function addTemplate($pageNumber = 1)
    {
        $this->pdf->setSourceFile($this->temp_file);
        $pageId = $this->pdf->importPage($pageNumber);
        $s = $this->pdf->getTemplatesize($pageId);
        $this->pdf->AddPage($s['orientation'], $s);
        $this->pdf->useTemplate($pageId);
    }

    public function render()
    {
        return view('livewire.welding-certificates.signer');
    }
}
