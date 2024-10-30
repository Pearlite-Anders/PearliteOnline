<?php

namespace App\Livewire\RoutineInspection;

use App\Models\RoutineInspection;
use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\WithFilters;
use App\Livewire\DataTable\WithSearch;
use Livewire\Component;

class Index extends Component
{
    use WithColumns, WithFilters, WithSearch;

    public $model = RoutineInspection::class;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.routine-inspection.index');
    }
}
