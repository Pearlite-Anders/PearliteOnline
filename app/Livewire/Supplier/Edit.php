<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Supplier;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public Supplier $supplier;

    public function update()
    {
        $this->form->update($this->supplier);

        return redirect()
                ->route('supplier.index')
                ->with('flash.banner', __('Supplier updated.'));
    }

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->form->setFields($supplier);
    }

    public function render()
    {
        return view('livewire.supplier.edit');
    }
}
