<?php

namespace App\Livewire\Wpqr;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Wpqr;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Wpqr $wpqr;

    public function update()
    {
        $this->form->update($this->wpqr);

        if($this->form->new_file) {
            return redirect()
                    ->route('wpqr.edit', $this->wpqr)
                    ->with('flash.banner', __('WPQR updated.'));
        }

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Welding Certificate updated successfully.')
        );
    }

    public function mount(Wpqr $wpqr)
    {
        $this->wpqr = $wpqr;
        $this->form->setFields($wpqr);
    }

    public function render()
    {
        return view('livewire.wpqr.edit');
    }
}
