<?php

namespace App\Livewire\RoutineInspection;

use App\Models\Company;
use App\Models\RoutineInspection;
use Livewire\Component;

class Wps extends Component
{
    private Company $company;

    public function mount()
    {
        $this->company = \Auth::user()->currentCompany;
    }

    public function render()
    {
        $wpss = RoutineInspection::wpss()->where('routine_inspections.company_id', '=', $this->company->id)->get();
        return view('livewire.routine-inspection.wps.page')->with('wpss', $wpss);
    }

    public function placeholder()
    {
        return view('livewire.routine-inspection.wps.placeholder');
    }
}