<?php


namespace App\Livewire\DataTable;

use App\Models\Project;
use Illuminate\Support\Str;

trait WithProject
{

    public function detachFromProject()
    {
        $relation = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->model)));
        $project = auth()->user()->currentCompany->projects->find($this->project_id);

        if($project) {
            foreach($this->selected as $id) {
                $model = $this->model::find($id);
                if(is_a($project->{$relation}(), \Illuminate\Database\Eloquent\Relations\HasMany::class)) {
                    $model->project_id = null;
                    $model->save();
                } else {
                    $project->{$relation}()->detach($model->id);
                }
            }
        }

        $this->dispatch('clearSelected');
    }
}
