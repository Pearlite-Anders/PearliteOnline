<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Create extends Component
{
    public Form $form;

    public function create()
    {
        $this->form->validate();
        $company = Company::create($this->form->all());
        $company->users()->attach(auth()->user());

        return redirect()->route('companies.index')->with('flash.banner', 'Company created.');
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('livewire.company.create');
    }
}
