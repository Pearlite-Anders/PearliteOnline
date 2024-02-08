<?php

namespace App\Livewire\WeldingCoordination;

use App\Models\WeldingCoordination;
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

class Index extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, WithColumns, WithFilters, WithDelete, WithSearch, WithClickableRow;

    public $model = WeldingCoordination::class;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.welding-coordination.index')->with([
            'weldingCoordinations' => $this->rows
        ]);
    }
}
