<?php

namespace App\Livewire\WeldingCoordination;

use App\Models\File;
use App\Models\WeldingCoordination;
use App\Data\WeldingCoordinationData;
use App\Models\WeldingCoordinationReport;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public $files = [];
    public $current_files;
    public $project_id;

    public function setFields(WeldingCoordination $weldingCoordination)
    {
        $this->data = WeldingCoordinationData::from($weldingCoordination->data);
        $this->project_id = $weldingCoordination->project_id;
        $this->current_files = collect($weldingCoordination->files)->map(function($file) {
            return File::find($file);
        });
    }

    public function create()
    {
        $weldingCoordination = WeldingCoordination::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        return $weldingCoordination;
    }

    public function update($weldingCoordination)
    {
        $weldingCoordination->update($this->transformedData());

        return $this->handleUploads($weldingCoordination);
    }

    public function transformedData()
    {
        $data = array_merge([
        ], $this->except([
            'files',
            'current_files',
        ]));

        return $data;
    }

    public function handleUploads($model)
    {
        $current_files = [];
        if($this->current_files) {
            foreach ($this->current_files as $file) {
                $current_files[] = $file->id;
            }
        }

        if($this->files) {
            foreach ($this->files as $file) {
                $current_files[] = File::fromTemporaryUpload($file, $model)->id;
            }
        }

        $model->files = $current_files;
        $model->save();

        return $model;
    }
}
