<?php

namespace App\Livewire\WeldingCoordination;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\WithTrixUploads;
use App\Data\WeldingCoordinationData;
use App\Models\WeldingCoordination;

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
        $this->authorize('create', new WeldingCoordination());
        $this->form->data = WeldingCoordinationData::from([]);
        $this->form->project_id = request('project_id');
    }

    public function render()
    {
        return view('livewire.welding-coordination.create');
    }
}
