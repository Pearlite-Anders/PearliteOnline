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
    public $project_id;

    public function setFields(TimeRegistration $registration)
    {
        $this->data = TimeRegistrationData::from($registration->data);
        $this->company_id = $registration->company_id;
        $this->project_id = $registration->project_id;
    }

    public function create()
    {
        $registration = TimeRegistration::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $registration->project()->associate($this->project_id);
        $registration->company()->associate($this->company_id);

        return $this->handleUploads($registration);
    }

    public function update($registration)
    {
        $registration->update($this->transformedData());
        $registration->project()->associate($this->project_id);
        $registration->company()->associate($this->company_id);

        return $this->handleUploads($registration);
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->except([
            'company_id',
            'project_id',
        ]));

        return $data;
    }

    public function handleUploads(TimeRegistration $registration)
    {
        return $registration;
    }

}
