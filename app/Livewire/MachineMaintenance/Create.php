<?php

namespace App\Livewire\MachineMaintenance;

use App\Data\MachineMaintenanceData;
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

        return redirect()->route('machine-maintenance.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->form->data = MachineMaintenanceData::from(['name' => '', 'status' => 'active']);
    }

    public function render()
    {
        return view('livewire.machine-maintenance.create');
    }
}
