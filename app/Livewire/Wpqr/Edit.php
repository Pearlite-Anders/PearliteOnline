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

        return redirect()
                ->route('wpqr.index')
                ->with('flash.banner', __('WPQR updated.'));
    }

    public function mount(Wpqr $wpqr)
    {
        $this->authorize('update', $wpqr);
        $this->wpqr = $wpqr;
        $this->form->setFields($wpqr);
    }

    public function render()
    {
        return view('livewire.wpqr.edit');
    }
}
