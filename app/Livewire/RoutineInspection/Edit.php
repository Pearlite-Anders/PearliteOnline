<?php

namespace App\Livewire\RoutineInspection;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\RoutineInspection;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public RoutineInspection $routineInspection;

    public function update()
    {
        $this->form->update($this->routineInspection);

        return redirect()
                ->route('routine-inspection.index')
                ->with('flash.banner', __('Routine inspection updated.'));
    }

    public function mount(RoutineInspection $routineInspection)
    {
        $this->routineInspection = $routineInspection;
        $this->form->setFields($routineInspection);
    }

    public function render()
    {
        return view('livewire.routine-inspection.edit');
    }
}
