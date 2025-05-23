<?php

namespace App\Livewire\Project;

use App\Data\ProjectData;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('project.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->authorize('create', new Project());
        $this->form->data = ProjectData::from(['name' => '', 'status' => 'active']);
    }

    public function render()
    {
        return view('livewire.project.create');
    }
}
