<?php

namespace App\Livewire\InternalOrder;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\InternalOrder;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;

    public function update()
    {
        $this->form->update();

        return redirect()
                ->route('internal-order.index')
                ->with('flash.banner', __('Internal Order updated.'));
    }

    public function mount(InternalOrder $internalOrder)
    {
        $this->authorize('update', $internalOrder);
        $this->form->setFields($internalOrder);
    }

    public function render()
    {
        return view('livewire.internal-order.edit');
    }
}
