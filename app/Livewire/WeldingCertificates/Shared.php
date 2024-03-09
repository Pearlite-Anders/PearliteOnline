<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    public function updated($property)
    {
        if($property == 'form.data.date_examination') {
            $years_to_add = 3;
            if(optional($this->form->data)['type'] == 'welding_operator_certificate') {
                $years_to_add = 6;
            }

            if(preg_match('/-/', $this->form->data->date_examination)) {
                $newDate = Carbon::createFromFormat('Y-m-d', $this->form->data->date_examination);
            } else {
                $newDate = Carbon::createFromFormat('Y.m.d', $this->form->data->date_examination);
            }

            $this->form->data->date_expiration = $newDate->addYears($years_to_add)->subDay()->format('Y.m.d');
        }

        if($property == 'form.data.last_signature') {
            if(preg_match('/-/', $this->form->data->last_signature)) {
                $newDate = Carbon::createFromFormat('Y-m-d', $this->form->data->last_signature);
            } else {
                $newDate = Carbon::createFromFormat('Y.m.d', $this->form->data->last_signature);
            }

            $this->form->data->date_next_signature = $newDate->addMonths(6)->format('Y.m.d');
        }
    }

    #[On('signature_boxes')]
    public function updateSignatureBoxes($boxes)
    {
        $this->form->data->signature_boxes = $boxes;
    }


}
