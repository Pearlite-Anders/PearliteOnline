<?php

namespace App\Livewire\Welder;

use App\Data\WelderData;
use App\Models\Welder;
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

        return redirect()->route('welder.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->authorize('create', new Welder());
        $this->form->data = WelderData::from(['name' => '', 'status' => 'active']);
        $this->form->project_id = request('project_id');
    }

    public function render()
    {
        return view('livewire.welder.create');
    }
}
