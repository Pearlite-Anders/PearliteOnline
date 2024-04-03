<?php

namespace App\Livewire\WeldingCoordination;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\WithTrixUploads;
use App\Data\WeldingCoordinationData;

class Create extends Component
{
    use Shared, WithFileUploads, WithTrixUploads;

    public Form $form;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('welding-coordination.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->form->data = WeldingCoordinationData::from([]);
        $this->form->project_id = request('project_id');
    }

    public function render()
    {
        return view('livewire.welding-coordination.create');
    }
}
