<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Str;

class AttachProject extends Component
{
    public $model;
    public $project_id;
    public $name;
    public $name_field;
    public $showModal = false;

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function attachModel($model_id)
    {
        $relation = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->model)));

        $relation_type = Project::find($this->project_id)->{$relation}();
        if(is_a($relation_type, \Illuminate\Database\Eloquent\Relations\HasMany::class)) {
            $model = $this->model::find($model_id);
            $model->project_id = $this->project_id;
            $model->save();
        } else {
            Project::find($this->project_id)->{$relation}()->attach($model_id);
        }

        return redirect()->route('project.edit', $this->project_id);
    }

    public function render()
    {
        $relation = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->model)));
        $models = [];

        if($this->showModal) {
            $project = Project::find($this->project_id);
            $models = auth()->user()->currentCompany->{$relation}()->whereNotIn('id', $project->{$relation}->pluck('id'))->get();

        }
        return view('livewire.attach-project')->with([
            'models' => $models
        ]);
    }
}
