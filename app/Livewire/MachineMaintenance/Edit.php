<?php

namespace App\Livewire\MachineMaintenance;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\MachineMaintenance;
use Illuminate\Support\Carbon;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public MachineMaintenance $machineMaintenance;
    public $reports;

    public bool $maintenanceFormOpen = false;

    public function update()
    {
        $this->form->update($this->machineMaintenance);

        return redirect()
                ->route('machine-maintenance.index')
                ->with('flash.banner', __('MachineMaintenance updated.'));
    }

    public function mount(MachineMaintenance $machineMaintenance)
    {
        $this->authorize('update', $machineMaintenance);
        $this->machineMaintenance = $machineMaintenance;
        $this->form->setFields($machineMaintenance);
        $this->reports = $machineMaintenance->reports()->with('user')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.machine-maintenance.edit');
    }

    public function toggleMaintenanceFormOpen(): void
    {
        $this->maintenanceFormOpen = !$this->maintenanceFormOpen;
    }

    public function updated($property)
    {
        if($property == 'form.data.maintenance_interval') {
            if(!$this->form->data->maintenance_interval || !isset($this->machineMaintenance->data['lastest_maintenance_date'])) {
                return;
            }

            $newDate = Carbon::createFromFormat('Y.m.d', $this->machineMaintenance->data['lastest_maintenance_date']);

            $this->form->data->next_maintenance_date = $newDate->addMonths((int)$this->form->data->maintenance_interval)->format('Y.m.d');
        }
    }

    #[On('delete-report')]
    public function deleteReport($id)
    {
        $report = $this->machineMaintenance->reports()->find($id);
        if ($report) {
            $report->delete();
        }

        $this->reports = $this->machineMaintenance->reports()->with('user')->get()->toArray();
    }
}
