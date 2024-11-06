<?php

namespace App\Livewire\Backoffice\InternalOrder;

use App\Models\InternalOrder;
use Livewire\Attributes\Layout;
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

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, WithColumns, WithFilters, WithDelete, WithSearch, WithClickableRow;

    public $model = InternalOrder::class;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.backoffice.internal-order.index')->with([
            'internalOrders' => $this->rows
        ]);
    }
}
