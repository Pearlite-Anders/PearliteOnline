<?php

namespace App\Livewire\RoutineInspection;

use App\Models\Company;
use App\Models\RoutineInspection;
use App\Models\Setting;
use Livewire\Component;

class WeldingEquipment extends Component
{
    private Company $company;
    public array $settings;

    public function mount()
    {
        $this->company = \Auth::user()->currentCompany;
        $this->settings = Setting::get('routine_inspection_welding_equipment');
    }

    public function render()
    {
        $equipments = RoutineInspection::weldingEquipment()->where('routine_inspections.company_id', '=', $this->company->id)->get();
        return view('livewire.routine-inspection.welding-equipment.page')->with(compact('equipments'));
    }

    public function placeholder()
    {
        return view('livewire.routine-inspection.welding-equipment.placeholder');
    }
}
