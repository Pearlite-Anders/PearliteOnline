<?php

namespace App\Livewire\Backoffice\InternalOrder;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\InternalOrder;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public InternalOrder $internalOrder;

    public function update()
    {
        $this->form->update();

        return redirect()
                ->route('backoffice.internal-order.index')
                ->with('flash.banner', __('Internal Order updated.'));
    }

    public function mount(InternalOrder $internalOrder)
    {
        $this->authorize('update', $internalOrder);
        $this->form->setFields($internalOrder);
        $this->internalOrder = $internalOrder;
    }

    public function render()
    {
        return view('livewire.backoffice.internal-order.edit');
    }
}
