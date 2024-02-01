<?php

namespace App\Livewire\Supplier;

use App\Data\SupplierData;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('supplier.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->form->data = SupplierData::from(['name' => '']);
    }

    public function render()
    {
        return view('livewire.supplier.create');
    }
}
