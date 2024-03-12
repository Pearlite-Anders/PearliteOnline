<?php

namespace App\Livewire\WeldingCertificates;

use App\Models\File;
use Livewire\Attributes\Rule;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Optional;
use Livewire\Attributes\Computed;
use App\Models\WeldingCertificate;
use Livewire\Form as LivewireForm;
use App\Data\WeldingCertificateData;

class Form extends LivewireForm
{
    public $welder_id;
    public $new_certificate;
    public $current_file;
    public $data;

    public function setFields(WeldingCertificate $weldingCertificate)
    {
        $this->welder_id = $weldingCertificate->welder_id;
        $this->data = WeldingCertificateData::from($weldingCertificate->data);

        if($weldingCertificate->current_file_id) {
            $this->current_file = File::find($weldingCertificate->current_file_id);
        }
    }

    public function create()
    {
        $welding_certificate = WeldingCertificate::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $welding_certificate = $this->handleUploads($welding_certificate);

        return $welding_certificate;
    }

    public function update($weldingCertificate)
    {
        $weldingCertificate->update($this->transformedData());

        return $this->handleUploads($weldingCertificate);
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->except([
            'new_certificate',
            'current_file',
            'uploaded_certificate'
        ]));

        if(optional($data['data'])['date_examination']) {
            if(preg_match('/\d{4}\.\d{2}\.\d{2}/', $data['data']['date_examination'])) {
                $data['data']['date_examination'] = Carbon::createFromFormat('Y.m.d', $data['data']['date_examination'])->format('Y-m-d');
            } else {
                $data['data']['date_examination'] = Carbon::parse($data['data']['date_examination'])->format('Y-m-d');
            }
        }

        if(optional($data['data'])['last_signature']) {
            if(preg_match('/\d{4}\.\d{2}\.\d{2}/', $data['data']['last_signature'])) {
                $data['data']['last_signature'] = Carbon::createFromFormat('Y.m.d', $data['data']['last_signature'])->format('Y-m-d');
            } else {
                $data['data']['last_signature'] = Carbon::parse($data['data']['last_signature'])->format('Y-m-d');
            }
        }

        return $data;
    }

    public function handleUploads(WeldingCertificate $welding_certificate)
    {
        if($this->new_certificate) {
            if($welding_certificate->current_file_id) {
                $previous_files = $welding_certificate->previous_files;
                $previous_files[] = $welding_certificate->current_file_id;
                $welding_certificate->previous_files = $previous_files;
            }

            $file = File::fromTemporaryUpload($this->new_certificate, $welding_certificate);
            $welding_certificate->current_file_id = $file->id;
            $welding_certificate->save();
        }

        return $welding_certificate;
    }

}
