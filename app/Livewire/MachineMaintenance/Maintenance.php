<?php

namespace App\Livewire\MachineMaintenance;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use App\Models\MachineMaintenance;
use App\Models\MachineMaintenanceMaintenance;
use Illuminate\Support\Carbon;

class Maintenance extends Component
{
    use WithFileUploads;
    public MachineMaintenance $machineMaintenance;
    public $reports;
    public $class;
    public $buttonText;

    public bool $maintenanceFormOpen = false;

    public $maintenance_date;
    public $maintenance_file;

    public function mount(MachineMaintenance $machineMaintenance, $class = null, $buttonText = null)
    {
        if ($buttonText == null) {
            $buttonText = __('New maintenance');
        }
        $this->authorize('update', $machineMaintenance);
        $this->machineMaintenance = $machineMaintenance;
        $this->class = $class;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('livewire.machine-maintenance.maintenance');
    }

    public function toggleMaintenanceFormOpen(): void
    {
        $this->maintenanceFormOpen = !$this->maintenanceFormOpen;
    }

    public function createReport()
    {
        $report = new MachineMaintenanceMaintenance();
        $report->machine_maintenance_id = $this->machineMaintenance->id;
        $report->user_id = auth()->user()->id;
        $report->data = [
            'maintenance_date' => $this->maintenance_date,
        ];
        $report->save();

        if($this->maintenance_file) {
            $file = File::fromTemporaryUpload($this->maintenance_file, $report, $report->machineMaintenance->company_id);
            $report->current_file_id = $file->id;
            $report->save();
        }

        // Update the MachineMaintenance's latest maintenance date to keep easier to figure out when the next assement is due.
        $machineMaintenanceData = $this->machineMaintenance->data;

        $machineMaintenanceData["lastest_maintenance_date"] = $this->maintenance_date;

        if ($machineMaintenanceData["maintenance_interval"]) {
            $date = Carbon::createFromFormat('Y.m.d', $this->maintenance_date);
            $machineMaintenanceData["next_maintenance_date"] = $date->addMonths($machineMaintenanceData["maintenance_interval"])->format('Y-m-d');
        }
        $this->machineMaintenance->data = $machineMaintenanceData;
        $this->machineMaintenance->save();

        $this->maintenanceFormOpen = false;
        $this->dispatch("maintenance-created");
    }
}
