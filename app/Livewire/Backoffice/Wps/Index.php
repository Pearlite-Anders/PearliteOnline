<?php

namespace App\Livewire\Backoffice\Wps;

use App\Models\Wps;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Models\WeldingCertificate;
use App\Livewire\DataTable\WithTable;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\WithSearch;
use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\WithFilters;
use App\Livewire\DataTable\WithProject;
use App\Livewire\DataTable\WithSorting;
use App\Livewire\DataTable\WithClickableRow;
use App\Livewire\DataTable\WithPerPagePagination;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, WithColumns, WithFilters, WithDelete, WithSearch, WithClickableRow, WithProject;

    public $model = Wps::class;

    public $compressed_header = false;
    public $attach_project = false;
    public $project_id;

    public function render()
    {
        $this->authorize('viewAny', $this->model);
        return view('livewire.backoffice.wps.index');
    }
}
