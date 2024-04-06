<?php

namespace App\Livewire\Wpqr;

use App\Models\Wpqr;
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

    public $model = Wpqr::class;
    public $compressed_header = false;
    public $attach_project = false;
    public $project_id;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.wpqr.index')->with([
            'wpqrs' => $this->rows
        ]);
    }
}
