<?php

namespace App\Livewire\Welder;

use App\Models\Welder;
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
use App\Livewire\DataTable\WithProject;

class Index extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, WithColumns, WithFilters, WithDelete, WithSearch, WithClickableRow, WithProject;

    public $model = Welder::class;
    public $compressed_header = false;
    public $attach_project = false;
    public $project_id;

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.welder.index')->with([
            'welders' => $this->rows
        ]);
    }
}
