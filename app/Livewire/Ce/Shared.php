<?php

namespace App\Livewire\Ce;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    public function updating($property, $value)
    {
        if($property == 'form.data.durability') {
            $current_value = $this->form->data->machining_quality;
            $new_value = '';

            if(in_array($value, [
                'C2 Høj',
                'C3 Høj',
                'C4 Middel',
                'C5 Middel',
                'C5 Lav',
                ]
            )) {
                $new_value = 'P2';
            }

            if(in_array($value, [
                'C1 Høj',
                'C1 Middel',
                'C2 Middel',
                'C3 Middel',
                'C4 Middel',
                'C5 Middel',
                'C1 Lav',
                'C2 Lav',
                'C3 Lav',
                'C4 Lav',
                ]
            )) {
                $new_value = 'P1';
            }

            if($new_value && $new_value != $current_value) {
                $this->form->data->machining_quality = $new_value;
                $this->dispatch(
                    'changeChoice',
                    'machining_quality',
                    $new_value
                );
            }
        }
    }
}
