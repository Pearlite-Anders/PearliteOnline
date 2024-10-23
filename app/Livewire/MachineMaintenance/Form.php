<?php

namespace App\Livewire\MachineMaintenance;

use App\Models\File;
use App\Models\MachineMaintenance;
use App\Data\MachineMaintenanceData;
use App\Models\MachineMaintenanceMaintenance;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public $new_images = [];
    public $new_files = [];
    public int $machine_maintenance_id;
    public $new_maintenance_date;
    public $new_maintenance_file;
    public $responsible_user_id;


    public function setFields(MachineMaintenance $machineMaintenance): void
    {
        $this->data = MachineMaintenanceData::from($machineMaintenance->data);
        $this->machine_maintenance_id = $machineMaintenance->id;
        $this->responsible_user_id = $machineMaintenance->responsible_user_id;
    }

    public function create()
    {
        $machineMaintenance = MachineMaintenance::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $machineMaintenance = $this->handleUploads($machineMaintenance);

        return $machineMaintenance;
    }

    public function update($machineMaintenance)
    {
        $machineMaintenance->update($this->transformedData());

        return $this->handleUploads($machineMaintenance);
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->except([
            'new_images',
            'new_files',
            'machine_maintenance_id',
            'new_maintenance_date',
            'new_maintenance_file'
        ]));

        return $data;
    }

    public function handleUploads(MachineMaintenance $machineMaintenance)
    {
        if($this->new_images) {
            $images = $machineMaintenance->images ?? [];

            foreach($this->new_images as $image) {
                $file = File::fromTemporaryUpload($image, $machineMaintenance);
                $images[] = $file->id;
            }
            $machineMaintenance->images = $images;
            $machineMaintenance->save();
        }

        if($this->new_files) {
            $files = $machineMaintenance->files ?? [];
            foreach($this->new_files as $file) {
                $file = File::fromTemporaryUpload($file, $machineMaintenance);
                $files[] = $file->id;
            }
            $machineMaintenance->files = $files;
            $machineMaintenance->save();
        }

        return $machineMaintenance;
    }

    public function createReport()
    {
        $report = new MachineMaintenanceMaintenance();
        $report->machine_maintenance_id = $this->machine_maintenance_id;
        $report->user_id = auth()->user()->id;
        $report->data = [
            'maintenance_date' => $this->new_maintenance_date,
        ];
        $report->save();

        if($this->new_maintenance_file) {
            $file = File::fromTemporaryUpload($this->new_maintenance_file, $report, $report->machineMaintenance->company_id);
            $report->current_file_id = $file->id;
            $report->save();
        }

        $machineMaintenance = MachineMaintenance::find($this->machine_maintenance_id);

        // Update the MachineMaintenance's latest maintenance date to keep easier to figure out when the next assement is due.
        $machineMaintenanceData = $machineMaintenance->data;
        $machineMaintenanceData["lastest_maintenance_date"] = $this->new_maintenance_date;
        $machineMaintenance->data = $machineMaintenanceData;
        $machineMaintenance->save();

        return $report;
    }

}
