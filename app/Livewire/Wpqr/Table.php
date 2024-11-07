<?php

namespace App\Livewire\Wpqr;

use App\Models\Wpqr;
use App\Models\User;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;
use Livewire\Component;
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

    public $model = Wpqr::class;
    #[Reactive]
    public Collection $columns;
    #[Reactive]
    public $filters;
    public $preset_filters = [];
    #[Reactive]
    public $search;

    public $resource;
    public bool $hideActions = false;

    public $compressed_header = false;
    public $attach_project = false;
    public $project_id;
    public string $editRoute = 'wpqr.edit';

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.wpqr.table')->with([
            'wpqrs' => $this->rows,
        ]);
    }

    public function resource()
    {
        if ($this->resource !== 'all') {
            return $this->resource->wpqrs('index');
        }

        if (\Auth::user()->isAdmin() || \Auth::user()->isPartner()) {
            return Wpqr::query()->whereIn('company_id', \Auth::user()->companies->pluck('id'));
        }

        return null;
    }
}
