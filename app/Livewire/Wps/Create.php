<?php

namespace App\Livewire\Wps;

use App\Data\WpsData;
use App\Models\Wps;
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

        return redirect()->route('wps.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->authorize('create', new Wps());
        $this->form->data = WpsData::from(['number' => '', 'status' => 'active']);
        $this->form->project_id = request('project_id');
    }

    public function render()
    {
        return view('livewire.wps.create');
    }
}
