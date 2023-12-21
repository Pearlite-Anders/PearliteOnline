<?php

namespace App\Livewire\ContactPerson;

use App\Models\File;
use Illuminate\Support\Carbon;
use App\Models\ContactPerson;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public $company;

    public function setFields(ContactPerson $contactPerson)
    {
        $this->data = $contactPerson->data;
        $this->company = $contactPerson->company;
    }

    public function create()
    {
        $contactPerson = ContactPerson::create($this->transformedData());

        return $contactPerson;
    }

    public function update($contactPerson)
    {
        $contactPerson->update($this->transformedData());

        return $contactPerson;
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => $this->company->id,
        ], $this->except(['company']));

        return $data;
    }
}
