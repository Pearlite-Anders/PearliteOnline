<?php

namespace App\Livewire\WeldingCertificates;

use App\Models\File;
use Livewire\Attributes\Rule;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use App\Models\WeldingCertificate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $number;
    public $welder_id;
    public $designation;
    public $welding_process;
    public $plate_pipe;
    public $type_of_weld;
    public $material_group;
    public $filler_material_type;
    public $filler_material_group;
    public $filler_material_designation;
    public $shielding_gas;
    public $type_of_current_and_polarity;
    public $material_thickness;
    public $deposited_thickness;
    public $outside_pip_diameter;
    public $welding_position;
    public $weld_details;
    public $date_examination;
    public $last_signature;
    public $new_certificate;

    private $uploaded_certificate;

    public function setFields(WeldingCertificate $weldingCertificate)
    {
        $this->welder_id = $weldingCertificate->welder_id;
        foreach($weldingCertificate->allMeta as $meta) {
            if($meta->type == 'date' && $meta->value) {
                $meta->value = $meta->value->format('Y.m.d');
            }
            $this->{$meta->key} = $meta->value;
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
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->all());

        if($data['new_certificate']) {
            $this->uploaded_certificate = $data['new_certificate'];
            unset($data['new_certificate']);
        }


        if($data['date_examination']) {
            $data['date_examination'] = Carbon::createFromFormat('Y.m.d', $data['date_examination'])->format('Y-m-d');
        }

        if($data['last_signature']) {
            $data['last_signature'] = Carbon::createFromFormat('Y.m.d', $data['last_signature'])->format('Y-m-d');
        }

        return $data;
    }

    public function handleUploads(WeldingCertificate $welding_certificate)
    {
        if($this->uploaded_certificate) {
            $file = File::fromTemporaryUpload($this->uploaded_certificate, $welding_certificate);
            $welding_certificate->current_certificate = $file->id;
            $welding_certificate->save();
        }

        return $welding_certificate;
    }

}
