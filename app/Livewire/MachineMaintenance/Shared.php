<?php

namespace App\Livewire\MachineMaintenance;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{

    public function createReport()
    {
        $this->form->createReport();

        return redirect()->route('machine-maintenance.edit', $this->form->machine_maintenance_id)->with('flash.banner', __('Maintenance created.'));
    }
}
