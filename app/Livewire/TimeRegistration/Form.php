<?php

namespace App\Livewire\TimeRegistration;

use App\Models\File;
use App\Models\TimeRegistration;
use App\Data\TimeRegistrationData;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public $company_id;
    public $internal_order_id;
    public $user_id;

    public function setFields(TimeRegistration $registration)
    {
        $this->data = TimeRegistrationData::from($registration->data);
        $this->company_id = $registration->company_id;
        $this->internal_order_id = $registration->internal_order_id;
        $this->user_id = $registration->user_id;
    }

    public function create()
    {
        $registration = TimeRegistration::create(array_merge([
        ], $this->transformedData()));

        if(auth()->user()->isAdmin()) {
            $registration->user()->associate($this->user_id);
        } else {
            $registration->user()->associate(auth()->user()->id);
        }
        $registration->internalOrder()->associate($this->internal_order_id);
        $registration->company()->associate($this->company_id);
        $registration->save();

        return $this->handleUploads($registration);
    }

    public function update($registration)
    {
        $registration->update($this->transformedData());

        if(auth()->user()->isAdmin()) {
            $registration->user()->associate($this->user_id);
        } else {
            $registration->user()->associate(auth()->user()->id);
        }
        $registration->internalOrder()->associate($this->internal_order_id);
        $registration->company()->associate($this->company_id);

        return $this->handleUploads($registration);
    }

    public function transformedData()
    {
        $data = array_merge([
        ], $this->except([
            'company_id',
            'internal_order_id',
        ]));

        return $data;
    }

    public function handleUploads(TimeRegistration $registration)
    {
        return $registration;
    }

}
