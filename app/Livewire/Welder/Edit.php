<?php

namespace App\Livewire\Welder;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Welder;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Welder $welder;

    public function update()
    {
        $this->form->update($this->welder);

        return redirect()
                ->route('welder.index')
                ->with('flash.banner', __('Welder updated.'));
    }

    public function mount(Welder $welder)
    {
        $this->authorize('update', $welder);
        $this->welder = $welder;
        $this->form->setFields($welder);
    }

    public function render()
    {
        return view('livewire.welder.edit');
    }
}
