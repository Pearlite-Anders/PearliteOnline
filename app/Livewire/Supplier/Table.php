<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
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

    public $model = Supplier::class;
    #[Reactive]
    public Collection $columns;
    public $resource;
    public bool $hideActions = false;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.supplier.table')->with([
            'suppliers' => $this->rows,
        ]);
    }

    public function resource()
    {
        return $this->resource->suppliers('index');
    }
}
