<?php

namespace App\Livewire\WeldingCertificates;

use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;

trait ComputedAttributes
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


}
