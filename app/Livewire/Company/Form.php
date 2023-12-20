<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Attributes\Rule;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;

    public function setFields(Company $company)
    {
        $this->data = $company->data;
    }

    public function create()
    {
        $company = Company::create($this->transformedData());

        return $company;
    }

    public function update($company)
    {
        $company->update($this->transformedData());

        return $company;
    }

    public function transformedData()
    {
        $data = $this->except([
        ]);

        return $data;
    }
}
