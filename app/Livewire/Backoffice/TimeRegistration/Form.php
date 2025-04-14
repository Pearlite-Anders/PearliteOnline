<?php

namespace App\Livewire\Backoffice\TimeRegistration;

use App\Data\CompanyData;
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

    public function setDrivingFromCompany()
    {
        if ($this->company_id && !$this->data->driving) {
            $company = auth()->user()->companies()->findOrFail($this->company_id);
            $companyData = CompanyData::from($company->data);
            $this->data->driving = $companyData->driving;
        }
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
        $registration->fill($this->transformedData());

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
