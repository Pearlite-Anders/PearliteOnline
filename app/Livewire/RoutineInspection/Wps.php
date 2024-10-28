<?php

namespace App\Livewire\RoutineInspection;

use App\Models\RoutineInspection;
use Livewire\Component;

class Wps extends Component
{
    public function render()
    {
        $wpss = RoutineInspection::wpss()->get();
        return view('livewire.routine-inspection.wps')->with('wpss', $wpss);
    }
}
