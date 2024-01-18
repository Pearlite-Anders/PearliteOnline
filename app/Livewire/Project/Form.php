<?php

namespace App\Livewire\Project;

use App\Models\File;
use App\Models\Project;
use App\Data\ProjectData;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $new_file;
    public $current_file;
    public $data;

    public function setFields(Project $project)
    {
        $this->data = ProjectData::from($project->data);

        if($project->current_file_id) {
            $this->current_file = File::find($project->current_file_id);
        }
    }

    public function create()
    {
        $project = Project::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $project = $this->handleUploads($project);

        return $project;
    }

    public function update($project)
    {
        $project->update($this->transformedData());

        return $this->handleUploads($project);
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

    public function handleUploads(Project $project)
    {
        if($this->new_file) {
            if($project->current_file_id) {
                $file = File::find($project->current_file_id);
                $file->delete();
            }

            $file = File::fromTemporaryUpload($this->new_file, $project);
            $project->current_file_id = $file->id;
            $project->save();
        }

        return $project;
    }

}
