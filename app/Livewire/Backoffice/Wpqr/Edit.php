<?php

namespace App\Livewire\Backoffice\Wpqr;

use App\Livewire\Wpqr\Form;
use App\Livewire\Wpqr\Shared;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Wpqr;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Wpqr $wpqr;

    public function update()
    {
        $this->form->update($this->wpqr);

        return redirect()
                ->route('backoffice.wpqr.index')
                ->with('flash.banner', __('WPQR updated.'));

    }

    public function mount(Wpqr $wpqr)
    {
        $this->wpqr = $wpqr;
        $this->form->setFields($wpqr);
    }

    public function render()
    {
        return view('livewire.backoffice.wpqr.edit');
    }
}
