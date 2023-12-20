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
        $this->form->update($this->company);

        return redirect()
                ->route('company.show', $this->company)
                ->with('flash.banner', __('Company updated.'));
    }

    public function mount(Company $company)
    {
        $this->company = $company;
        $this->form->setFields($company);
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('livewire.company.edit');
    }
}
