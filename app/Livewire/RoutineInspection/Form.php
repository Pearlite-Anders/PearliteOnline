<?php

namespace App\Livewire\RoutineInspection;

use App\Data\RoutineInspectionData;
use App\Models\RoutineInspection;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public $project_id;
    public $wps_id;
    public $welder_id;

    public function setFields(RoutineInspection $routineInspection)
    {
        $this->data = RoutineInspectionData::from($routineInspection->data);

        $this->project_id = $routineInspection->project_id;
        $this->wps_id = $routineInspection->wps_id;
        $this->welder_id = $routineInspection->welder_id;
    }

    public function create()
    {
        $routineInspection = RoutineInspection::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        return $routineInspection;
    }

    public function update(RoutineInspection $routineInspection)
    {
        $routineInspection->update($this->transformedData());
    }

    public function transformedData()
    {
        $data = array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->except([

        ]));

        return $data;
    }
}
