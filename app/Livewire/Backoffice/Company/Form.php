<?php

namespace App\Livewire\Backoffice\Company;

use App\Models\Company;
use App\Data\CompanyData;
use Livewire\Attributes\Rule;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;

    public function rules()
    {
        return [
            'data.name' => ['required', 'string', 'max:255'],
            'data.address' => [],
            'data.city' => [],
            'data.state' => [],
            'data.zip' => [],
            'data.phone' => [],
            'data.email' => [],
            'data.website' => [],
            'data.logo' => [],
            'data.notes' => [],
            'data.active' => [],
        ];
    }

    public function setFields(Company $company)
    {
        $this->data = CompanyData::from($company->data);
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
