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
    public $company;
    public $project;

    public function setFields(TimeRegistration $registration)
    {
        $this->data = TimeRegistrationData::from($registration->data);
    }

    public function create()
    {
        $registration = TimeRegistration::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $registration->project()->associate($this->project);
        $registration->company()->associate($this->company);

        return $this->handleUploads($registration);
    }

    public function update($registration)
    {
        $registration->update($this->transformedData());

        return $this->handleUploads($registration);
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->except([
            'company',
            'project',
        ]));

        return $data;
    }

    public function handleUploads(TimeRegistration $registration)
    {
        return $registration;
    }

}
