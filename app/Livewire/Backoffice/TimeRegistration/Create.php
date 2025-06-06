<?php

namespace App\Livewire\Backoffice\TimeRegistration;

use App\Data\TimeRegistrationData;
use App\Models\TimeRegistration;
use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.backoffice')]
class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public $duplicate_id;
    public ?TimeRegistration $registration;

    protected $queryString = ['duplicate_id'];

    public function create()
    {
        $this->form->create();

        return redirect()->route('backoffice.time-registration.index')->with('flash.banner', __('Time Registration Created.'));
    }

    public function mount()
    {
        $this->authorize('create', new TimeRegistration());
        if ($this->duplicate_id) {
            $timeRegistration = TimeRegistration::find($this->duplicate_id);
            $this->registration = $timeRegistration->replicate();
            $this->form->setFields($this->registration);
        } else {
            $this->form->data = TimeRegistrationData::from(['paid' => true]);
            $this->form->user_id = auth()->user()->id;
        }

        if ($this->form->data->break_time == null) {
            $this->form->data->break_time = Setting::get('time_registration_default_break_duration', 0);
        }
    }

    public function render()
    {
        $this->form->setDrivingFromCompany();
        return view('livewire.backoffice.time-registration.create');
    }
}
