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
        $this->authorize('create', new Supplier());
        $this->form->data = SupplierData::from(['name' => '', 'status' => 'active']);
        $this->supplier = new Supplier();

    }

    public function render()
    {
        return view('livewire.supplier.create');
    }

    public function updated($property)
    {
        if($property == 'form.data.assessment_frequency') {
            if(!$this->form->data->assessment_frequency) {
                return;
            }
            $this->form->data->next_assessment = now()->addMonths((int)$this->form->data->assessment_frequency)->format('Y.m.d');
        }
    }
}
