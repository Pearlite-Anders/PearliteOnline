<?php

namespace App\Livewire\RoutineInspection;

use Livewire\Component;
use Livewire\Attributes\Reactive;

use App\Models\RoutineInspection;
use App\Models\WeldingCertificate;
use App\Livewire\DataTable\WithTable;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\BaseSearch;
use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\BaseFilters;
use App\Livewire\DataTable\WithSorting;
use App\Livewire\DataTable\WithClickableRow;
use App\Livewire\DataTable\WithPerPagePagination;
use Illuminate\Support\Collection;

class Table extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, BaseFilters, WithDelete, BaseSearch, WithClickableRow;

    public $model = RoutineInspection::class;
    #[Reactive]
    public Collection $columns;
    #[Reactive]
    public $filters;
    public $preset_filters = [];
    #[Reactive]
    public $search;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.routine-inspection.table.page')->with([
            'routineInspections' => $this->rows
        ]);
    }

    public function placeholder()
    {
        return view('livewire.routine-inspection.table.placeholder');
    }
}
