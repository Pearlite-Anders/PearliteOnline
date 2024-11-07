<?php

namespace App\Livewire\TimeRegistration;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\TimeRegistration;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public TimeRegistration $registration;

    public function update()
    {
        $this->form->update($this->registration);

        return redirect()
                ->route('time-registration.index')
                ->with('flash.banner', __('TimeRegistration updated.'));
    }

    public function mount(TimeRegistration $timeRegistration)
    {
        $this->authorize('update', $timeRegistration);
        $this->registration = $timeRegistration;
        $this->form->setFields($timeRegistration);
    }

    public function render()
    {
        $this->form->setDrivingFromCompany();
        return view('livewire.time-registration.edit');
    }
}
