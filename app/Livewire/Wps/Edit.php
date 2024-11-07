<?php

namespace App\Livewire\Wps;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Wps;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Wps $wps;

    public function update()
    {
        $this->form->update($this->wps);

        return redirect()
                ->route('wps.index')
                ->with('flash.banner', __('WPS updated.'));

    }

    public function mount(Wps $wps)
    {
        $this->authorize('update', $wps);
        $this->wps = $wps;
        $this->form->setFields($wps);
    }

    public function render()
    {
        return view('livewire.wps.edit');
    }
}
