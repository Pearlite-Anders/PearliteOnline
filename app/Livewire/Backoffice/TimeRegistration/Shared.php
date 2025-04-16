<?php

namespace App\Livewire\Backoffice\TimeRegistration;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    public function updated($property)
    {
        if ($property == 'form.data.start' || $property == 'form.data.end' || $property == 'form.data.break_time' || $property == 'form.data.break') {
            if (!$this->form->data->start || !$this->form->data->end) {
                return;
            }


            $start = Carbon::createFromFormat('H:i', $this->form->data->start);
            $end = Carbon::createFromFormat('H:i', $this->form->data->end);

            if ($this->form->data->break) {
                $break_time = 0;
                if (is_numeric($this->form->data->break_time)) {
                    $break_time = intval($this->form->data->break_time);
                }
                $end->subMinutes($break_time);
            }

            if ($start->isAfter($end)) {
                $diff = "0:00";
            } else {
                $diff = $start->diffInHours($end);
                $diffMinutes = $start->diffInMinutes($end) % 60;
                if ($diffMinutes) {
                    if ($diffMinutes < 10) {
                        $diffMinutes = '0' . $diffMinutes;
                    }

                    $diff .= ':' . $diffMinutes;
                }
            }

            $this->form->data->hours = $diff;
        }
    }
}
