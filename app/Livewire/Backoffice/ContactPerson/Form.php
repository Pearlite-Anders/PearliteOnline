<?php

namespace App\Livewire\Backoffice\ContactPerson;

use App\Models\File;
use App\Models\ContactPerson;
use Illuminate\Support\Carbon;
use App\Data\ContactPersonData;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public $company;

    public function setFields(ContactPerson $contactPerson)
    {
        $this->data = ContactPersonData::from($contactPerson->data);
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
