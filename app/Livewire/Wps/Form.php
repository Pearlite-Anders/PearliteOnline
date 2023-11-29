<?php

namespace App\Livewire\Wps;

use App\Models\File;
use Illuminate\Support\Carbon;
use App\Models\Wps;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $new_file;
    public $current_file;
    public $wpqr_id;
    public $data;

    public function setFields(Wps $wps)
    {
        $this->data = $wps->data;
        $this->wpqr_id = $wps->wpqr_id;

        if($wps->current_file_id) {
            $this->current_file = File::find($wps->current_file_id);
        }
    }

    public function create()
    {
        $wps = Wps::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $wps = $this->handleUploads($wps);

        return $wps;
    }

    public function update($wps)
    {
        $wps->update($this->transformedData());

        return $this->handleUploads($wps);
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->except([
            'new_file',
            'current_file',
            'uploaded_certificate'
        ]));

        return $data;
    }

    public function handleUploads(Wps $wps)
    {
        if($this->new_file) {
            if($wps->current_file_id) {
                $file = File::find($wps->current_file_id);
                $file->delete();
            }

            $file = File::fromTemporaryUpload($this->new_file, $wps);
            $wps->current_file_id = $file->id;
            $wps->save();
        }

        return $wps;
    }

}
