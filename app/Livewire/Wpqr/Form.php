<?php

namespace App\Livewire\Wpqr;

use App\Models\File;
use App\Models\Wpqr;
use App\Data\WpqrData;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $new_file;
    public $current_file;
    public $data;

    public function setFields(Wpqr $wpqr)
    {
        $this->data = WpqrData::from($wpqr->data);

        if($wpqr->current_file_id) {
            $this->current_file = File::find($wpqr->current_file_id);

        }
    }

    public function create()
    {
        $wpqr = Wpqr::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $wpqr = $this->handleUploads($wpqr);

        return $wpqr;
    }

    public function update($wpqr)
    {
        $wpqr->update($this->transformedData());

        return $this->handleUploads($wpqr);
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

    public function handleUploads(Wpqr $wpqr)
    {
        if($this->new_file) {
            if($wpqr->current_file_id) {
                $file = File::find($wpqr->current_file_id);
                $file->delete();
            }

            $file = File::fromTemporaryUpload($this->new_file, $wpqr);
            $wpqr->current_file_id = $file->id;
            $wpqr->save();
        }

        return $wpqr;
    }

}
