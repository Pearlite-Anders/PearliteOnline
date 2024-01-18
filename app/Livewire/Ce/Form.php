<?php

namespace App\Livewire\Ce;

use App\Data\CeData;
use App\Models\File;
use Illuminate\Support\Carbon;
use App\Models\Ce;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $new_file;
    public $current_file;
    public $data;
    public $project_id;

    public function setFields(Ce $ce)
    {
        $this->data = CeData::from($ce->data);

        if($ce->current_file_id) {
            $this->current_file = File::find($ce->current_file_id);
        }

        $this->project_id = $ce->project_id;
    }

    public function create()
    {
        $ce = Ce::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $ce = $this->handleUploads($ce);

        return $ce;
    }

    public function update($ce)
    {
        $ce->update($this->transformedData());

        return $this->handleUploads($ce);
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

    public function handleUploads(Ce $ce)
    {
        if($this->new_file) {
            if($ce->current_file_id) {
                $previous_files = $ce->previous_files;
                $previous_files[] = $ce->current_file_id;
                $ce->previous_files = $previous_files;
            }

            $file = File::fromTemporaryUpload($this->new_file, $ce);
            $ce->current_file_id = $file->id;
            $ce->save();
        }

        return $ce;
    }

}
