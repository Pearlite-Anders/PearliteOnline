<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class AttachToProject extends Component
{
    public $model;
    public $showModal = false;
    public $selected = [];

    public function attachModel($project_id)
    {
        $project = auth()->user()->currentCompany->projects->find($project_id);
        if($project) {
            foreach($this->selected as $id) {
                $model = $this->model::find($id);
                $relation = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->model)));
                if(is_a($project->{$relation}(), \Illuminate\Database\Eloquent\Relations\HasMany::class)) {
                    $model->project_id = $project_id;
                    $model->save();
                } else {
                    $project->{$relation}()->attach($model->id);
                }
            }
        }

        $this->showModal = false;
        $this->dispatch('clearSelected');
    }

    public function render()
    {
        return view('livewire.attach-to-project')->with([
            'projects' => auth()->user()->currentCompany->projects,
        ]);
    }
}
