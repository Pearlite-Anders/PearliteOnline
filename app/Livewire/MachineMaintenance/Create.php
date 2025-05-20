<?php

namespace App\Livewire\MachineMaintenance;

use App\Data\MachineMaintenanceData;
use App\Models\MachineMaintenance;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('machine-maintenance.index')->with('flash.banner', __('Maintenance created.'));
    }

    public function mount()
    {
        $this->authorize('create', new MachineMaintenance());
        $this->form->data = MachineMaintenanceData::from(['name' => '', 'status' => 'active']);
    }

    public function updated($property)
    {
        if($property == 'form.data.maintenance_interval') {
            if(!$this->form->data->maintenance_interval) {
                return;
            }
            $this->form->data->next_maintenance_date = now()->addMonths((int)$this->form->data->maintenance_interval)->format('Y.m.d');
        }
    }

    public function render()
    {
        return view('livewire.machine-maintenance.create');
    }
}
