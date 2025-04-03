<?php

namespace App\Livewire\Backoffice\ContactPerson;

use App\Models\Company;
use App\Models\ContactPerson;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Data\ContactPersonData;

#[Layout('layouts.backoffice')]
class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;
    public Company $company;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('backoffice.companies.show', $this->company)->with('flash.banner', __('Contact Person Created.'));
    }

    public function mount(Company $company)
    {
        $this->authorize('create', new ContactPerson());
        $this->company = $company;

        $this->form->company = $company;
        $this->form->data = ContactPersonData::from([
            'name' => ''
        ]);
    }

    public function render()
    {
        return view('livewire.backoffice.contact-person.create');
    }
}
