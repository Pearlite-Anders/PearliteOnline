<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Project;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Project $project;

    public function update()
    {
        $this->form->update($this->project);

        return redirect()
                ->route('project.index')
                ->with('flash.banner', __('Project updated.'));
    }

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->form->setFields($project);
    }

    public function render()
    {
        return view('livewire.project.edit');
    }
}
