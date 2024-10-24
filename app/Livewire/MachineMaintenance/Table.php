<?php

namespace App\Livewire\MachineMaintenance;

use App\Models\MachineMaintenance;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\WeldingCertificate;
use App\Livewire\DataTable\WithTable;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\WithSearch;
use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\WithFilters;
use App\Livewire\DataTable\WithSorting;
use App\Livewire\DataTable\WithClickableRow;
use App\Livewire\DataTable\WithPerPagePagination;
use Illuminate\Support\Collection;

class Table extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, WithFilters, WithDelete, WithSearch, WithClickableRow;

    public $model = MachineMaintenance::class;
    #[Reactive]
    public Collection $columns;
    public $resource;
    public bool $hideActions = false;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.machine-maintenance.table')->with([
            'machineMaintenances' => $this->rows,
        ]);
    }

    public function resource()
    {
        return $this->resource;
    }

    public function getRowsQueryProperty()
    {
        if($this->preset_filters) {
            $this->filters = $this->preset_filters;
        }

        $query = $this->resource()->machineMaintenances()
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->when($this->filters, fn ($query, $filters) => $this->applyFilters($query, $filters))
                    ->when($this->with(), fn ($query, $with) => $query->with($with));

        return $this->applySorting($query);
    }
}
