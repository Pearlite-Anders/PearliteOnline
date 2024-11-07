<?php

namespace App\Livewire\Backoffice\Company;

use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Data\CompanyData;

#[Layout('layouts.backoffice')]
class Create extends Component
{
    public Form $form;

    public function create()
    {
        $this->form->validate();
        $company = Company::create($this->form->all());
        $company->users()->attach(auth()->user());

        return redirect()->route('backoffice.companies.index')->with('flash.banner', 'Company created.');
    }

    public function mount()
    {
        $this->authorize('create', new Company());
        $this->form->data = CompanyData::from(['name' => '']);
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('livewire.backoffice.company.create');
    }
}
