<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    #[Computed]
    public function date_expiration()
    {
        if(optional($this->form->data)['date_examination']) {
            if(preg_match('/-/', $this->form->data['date_examination'])) {
                return Carbon::createFromFormat('Y-m-d', $this->form->data['date_examination'])->addYears(3)->format('Y.m.d');
            }
            return Carbon::createFromFormat('Y.m.d', $this->form->data['date_examination'])->addYears(3)->format('Y.m.d');
        }

        return '';
    }

    #[Computed]
    public function date_next_signature()
    {
        if(optional($this->form->data)['last_signature']) {
            if(preg_match('/-/', $this->form->data['last_signature'])) {
                return Carbon::createFromFormat('Y-m-d', $this->form->data['last_signature'])->addMonths(6)->format('Y.m.d');
            }
            return Carbon::createFromFormat('Y.m.d', $this->form->data['last_signature'])->addMonths(6)->format('Y.m.d');
        }

        return '';
    }

    #[On('signature_boxes')]
    public function updateSignatureBoxes($boxes)
    {
        $this->form->data->signature_boxes = $boxes;
    }


}
