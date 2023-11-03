<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;

trait Shared
{
    #[Computed]
    public function date_expiration()
    {
        if($this->form->date_examination) {
            return Carbon::createFromFormat('Y.m.d', $this->form->date_examination)->addYears(3)->format('Y.m.d');
        }

        return '';
    }

    #[Computed]
    public function date_next_signature()
    {
        if($this->form->last_signature) {
            return Carbon::createFromFormat('Y.m.d', $this->form->last_signature)->addMonths(6)->format('Y.m.d');
        }

        return '';
    }

    #[On('signature_boxes')]
    public function updateSignatureBoxes($boxes)
    {
        $this->form->signature_boxes = $boxes;
    }


}
