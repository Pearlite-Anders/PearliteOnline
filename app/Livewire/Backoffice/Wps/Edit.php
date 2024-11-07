<?php

namespace App\Livewire\Backoffice\Wps;

use App\Livewire\Wps\Form;
use App\Livewire\Wps\Shared;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Wps;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Wps $wps;

    public function update()
    {
        $this->form->update($this->wps);

        return redirect()
                ->route('backoffice.wps.index')
                ->with('flash.banner', __('WPS updated.'));

    }

    public function mount(Wps $wps)
    {
        $this->wps = $wps;
        $this->form->setFields($wps);
    }

    public function render()
    {
        return view('livewire.backoffice.wps.edit');
    }
}
