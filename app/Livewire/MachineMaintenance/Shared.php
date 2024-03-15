<?php

namespace App\Livewire\MachineMaintenance;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    public function updated($property)
    {
        if($property == 'form.data.last_maintenance_date' || $property == 'form.data.maintenance_interval') {
            if(!$this->form->data->maintenance_interval || !$this->form->data->last_maintenance_date) {
                return;
            }

            if(preg_match('/-/', $this->form->data->last_maintenance_date)) {
                $newDate = Carbon::createFromFormat('Y-m-d', $this->form->data->last_maintenance_date);
            } else {
                $newDate = Carbon::createFromFormat('Y.m.d', $this->form->data->last_maintenance_date);
            }

            $this->form->data->next_maintenance_date = $newDate->addMonths((int)$this->form->data->maintenance_interval)->format('Y.m.d');
        }
    }
}
