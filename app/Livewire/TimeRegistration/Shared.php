<?php

namespace App\Livewire\TimeRegistration;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    public function updated($property)
    {
        if ($property == 'form.data.start' || $property == 'form.data.end') {
            if (!$this->form->data->start || !$this->form->data->end) {
                return;
            }

            $start = Carbon::createFromFormat('H:i', $this->form->data->start);
            $end = Carbon::createFromFormat('H:i', $this->form->data->end);

            $diff = $start->diffInHours($end);
            $diffMinutes = $start->diffInMinutes($end) % 60;
            if ($diffMinutes) {
                $diff .= ':' . $diffMinutes;
            }

            $this->form->data->hours = $diff;
        }
    }
}
