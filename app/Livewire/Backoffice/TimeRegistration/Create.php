<?php

namespace App\Livewire\Backoffice\TimeRegistration;

use App\Data\TimeRegistrationData;
use App\Models\TimeRegistration;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.backoffice')]
class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public function create()
    {
        $this->form->create();

        return redirect()->route('backoffice.time-registration.index')->with('flash.banner', __('Time Registration Created.'));
    }

    public function mount()
    {
        $this->authorize('create', new TimeRegistration());
        $this->form->data = TimeRegistrationData::from([]);
    }

    public function render()
    {
        $this->form->setDrivingFromCompany();
        return view('livewire.backoffice.time-registration.create');
    }
}
