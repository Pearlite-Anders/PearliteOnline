<?php

namespace App\Livewire\Backoffice\Company;

use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    public Form $form;
    public Company $company;

    public function update()
    {
        $this->form->update($this->company);

        return redirect()
                ->route('backoffice.companies.show', $this->company)
                ->with('flash.banner', __('Company updated.'));
    }

    public function mount(Company $company)
    {
        $this->authorize('update', $company);
        $this->company = $company;
        $this->form->setFields($company);
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('livewire.backoffice.company.edit');
    }
}
