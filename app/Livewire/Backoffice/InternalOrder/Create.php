<?php

namespace App\Livewire\Backoffice\InternalOrder;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\InternalOrder;
use App\Data\InternalOrderData;
use Livewire\WithFileUploads;

#[Layout('layouts.backoffice')]
class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;
    public $internalOrder;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('backoffice.internal-order.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->authorize('create', new InternalOrder());
        $this->form->data = InternalOrderData::from(['name' => '', 'status' => 'active']);
        $this->supplier = new InternalOrder();

    }

    public function render()
    {
        return view('livewire.backoffice.internal-order.create');
    }
}
