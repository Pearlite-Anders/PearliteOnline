<?php

namespace App\Livewire\Ce;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Ce;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Ce $ce;

    public function update()
    {
        $this->form->update($this->ce);

        return redirect()
                ->route('ce.index')
                ->with('flash.banner', __('CE Marking updated.'));
    }

    public function mount(Ce $ce)
    {
        $this->authorize('update', $ce);
        $this->ce = $ce;
        $this->form->setFields($ce);
    }

    public function render()
    {
        return view('livewire.ce.edit');
    }
}
