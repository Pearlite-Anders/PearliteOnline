<?php

namespace App\Livewire\Document;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait NextReviewDate
{
    public function updated($property)
    {
        if($property == 'form.data.lastest_review_date' || $property == 'form.data.review_interval') {
            if(!$this->form->data->review_interval || !$this->form->data->lastest_review_date) {
                return;
            }

            if(preg_match('/-/', $this->form->data->lastest_review_date)) {
                $newDate = Carbon::createFromFormat('Y-m-d', $this->form->data->lastest_review_date);
            } else {
                $newDate = Carbon::createFromFormat('Y.m.d', $this->form->data->lastest_review_date);
            }

            $this->form->data->next_review_date = $newDate->addMonths((int)$this->form->data->review_interval)->format('Y.m.d');
        }
    }
}
