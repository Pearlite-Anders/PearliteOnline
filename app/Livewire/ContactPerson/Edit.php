<?php

namespace App\Livewire\ContactPerson;

use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ContactPerson;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public ContactPerson $contactPerson;
    public Company $company;

    public function update()
    {
        $this->form->update($this->contactPerson);

        return redirect()
                ->route('companies.show', $this->company)
                ->with('flash.banner', __('Contact Person Updated.'));
    }

    public function mount(Company $company, ContactPerson $contactPerson)
    {
        $this->company = $company;
        $this->contactPerson = $contactPerson;
        $this->form->setFields($contactPerson);
    }

    public function render()
    {
        return view('livewire.contact-person.edit');
    }
}
