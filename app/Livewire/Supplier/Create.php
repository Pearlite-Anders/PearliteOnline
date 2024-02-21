<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use App\Data\SupplierData;
use Livewire\WithFileUploads;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;
    public $supplier;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('supplier.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->form->data = SupplierData::from(['name' => '']);
        $this->supplier = new Supplier();

    }

    public function render()
    {
        return view('livewire.supplier.create');
    }
}
