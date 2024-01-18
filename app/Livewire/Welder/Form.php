<?php

namespace App\Livewire\Welder;

use App\Models\File;
use App\Models\Welder;
use App\Data\WelderData;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $new_file;
    public $current_file;
    public $data;

    public function setFields(Welder $welder)
    {
        $this->data = WelderData::from($welder->data);

        if($welder->current_file_id) {
            $this->current_file = File::find($welder->current_file_id);
        }
    }

    public function create()
    {
        $welder = Welder::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $welder = $this->handleUploads($welder);

        return $welder;
    }

    public function update($welder)
    {
        $welder->update($this->transformedData());

        return $this->handleUploads($welder);
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

    public function handleUploads(Welder $welder)
    {
        if($this->new_file) {
            if($welder->current_file_id) {
                $file = File::find($welder->current_file_id);
                $file->delete();
            }

            $file = File::fromTemporaryUpload($this->new_file, $welder);
            $welder->current_file_id = $file->id;
            $welder->save();
        }

        return $welder;
    }

}
