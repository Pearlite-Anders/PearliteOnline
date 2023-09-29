<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Edit extends Component
{
    public Form $form;
    public Company $company;

    public function update()
    {
        $this->form->validate();

        $this->company->update([
            'name' => $this->form->name,
        ]);

        $this->dispatch('banner-message',
            style: 'success',
            message: __('Company updated successfully.')
        );
    }

    public function mount(Company $company)
    {
        $this->company = $company;
        $this->form->name = $company->name;
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('livewire.company.edit');
    }
}
