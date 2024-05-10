<?php

namespace App\Livewire\InternalOrder;

use Livewire\Component;
use App\Models\InternalOrder;
use App\Data\InternalOrderData;
use Livewire\WithFileUploads;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;
    public $internalOrder;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('internal-order.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->form->data = InternalOrderData::from(['name' => '', 'status' => 'active']);
        $this->supplier = new InternalOrder();

    }

    public function render()
    {
        return view('livewire.internal-order.create');
    }
}
