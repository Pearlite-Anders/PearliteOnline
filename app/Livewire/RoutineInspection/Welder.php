<?php

namespace App\Livewire\RoutineInspection;

use App\Models\Company;
use App\Models\RoutineInspection;
use Livewire\Component;

class Welder extends Component
{
    private Company $company;

    public function mount()
    {
        $this->company = \Auth::user()->currentCompany;
    }

    public function render()
    {
        $welders = RoutineInspection::welders()->where('routine_inspections.company_id', '=', $this->company->id)->get();
        return view('livewire.routine-inspection.welder.page')->with(compact('welders'));
    }

    public function placeholder()
    {
        return view('livewire.routine-inspection.welder.placeholder');
    }
}
