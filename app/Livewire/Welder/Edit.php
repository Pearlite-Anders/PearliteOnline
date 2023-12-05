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

        if($this->form->new_file) {
            return redirect()
                    ->route('welder.edit', $this->welder)
                    ->with('flash.banner', __('WPQR updated.'));
        }

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Welding Certificate updated successfully.')
        );
    }

    public function mount(Welder $welder)
    {
        $this->welder = $welder;
        $this->form->setFields($welder);
    }

    public function render()
    {
        return view('livewire.welder.edit');
    }
}
