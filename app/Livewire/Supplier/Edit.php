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
    public $reports;

    public function update()
    {
        $this->form->update($this->supplier);

        return redirect()
                ->route('supplier.index')
                ->with('flash.banner', __('Supplier updated.'));
    }

    public function mount(Supplier $supplier)
    {
        $this->authorize('update', $supplier);
        $this->supplier = $supplier;
        $this->form->setFields($supplier);
        $this->reports = $this->supplier->reports()->with('user')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.supplier.edit');
    }

    #[On('assessment-created')]
    public function assessmentCreated()
    {
        $this->reports = $this->supplier->reports()->with('user')->get()->toArray();
        $this->supplier->refresh();
        $this->form->setFields($this->supplier);
    }

    public function updated($property)
    {
        if ($property == 'form.data.assessment_frequency') {

            if(!$this->form->data->assessment_frequency) {
                return;
            }

            $latestAssessment = $this->supplier->latestAssessment();
            if (!$latestAssessment) {
                return;
            }

            $this->form->data->next_assessment = $latestAssessment->addMonths((int)$this->form->data->assessment_frequency)->format('Y.m.d');
        }
    }
}
