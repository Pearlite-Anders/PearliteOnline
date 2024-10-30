<?php

namespace App\Livewire\RoutineInspection;

use App\Data\RoutineInspectionData;
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

        return redirect()->route('routine-inspection.index')->with('flash.banner', __('Routine inspection created.'));
    }

    public function mount()
    {
        $this->form->data = RoutineInspectionData::from([]);
    }

    public function render()
    {
        return view('livewire.routine-inspection.create');
    }
}
