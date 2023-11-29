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

        if($this->form->new_file) {
            return redirect()
                    ->route('wps.edit', $this->wps)
                    ->with('flash.banner', __('WPQR updated.'));
        }

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Welding Certificate updated successfully.')
        );
    }

    public function mount(Wps $wps)
    {
        $this->wps = $wps;
        $this->form->setFields($wps);
    }

    public function render()
    {
        return view('livewire.wps.edit');
    }
}
