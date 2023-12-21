<?php

namespace App\Livewire\ContactPerson;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Data\ContactPersonData;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;
    public Company $company;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('companies.show', $this->company)->with('flash.banner', __('Contact Person Created.'));
    }

    public function mount(Company $company)
    {
        $this->company = $company;

        $this->form->company = $company;
        $this->form->data = ContactPersonData::from([
            'name' => ''
        ]);
    }

    public function render()
    {
        return view('livewire.contact-person.create');
    }
}
