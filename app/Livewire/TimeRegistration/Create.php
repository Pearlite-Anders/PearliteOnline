<?php

namespace App\Livewire\TimeRegistration;

use App\Data\TimeRegistrationData;
use App\Models\TimeRegistration;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public function create()
    {
        $this->form->create();

        return redirect()->route('time-registration.index')->with('flash.banner', __('Time Registration Created.'));
    }

    public function mount()
    {
        $this->authorize('create', new TimeRegistration());
        $this->form->data = TimeRegistrationData::from([]);
    }

    public function render()
    {
        $this->form->setDrivingFromCompany();
        return view('livewire.time-registration.create');
    }
}
