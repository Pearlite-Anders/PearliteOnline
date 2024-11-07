<?php

namespace App\Livewire\Wps;

use App\Models\Wps;
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

    public $model = Wps::class;
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
    public string $editRoute = 'wps.edit';

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.wps.table')->with([
            'wpss' => $this->rows,
        ]);
    }

    public function resource()
    {
        if ($this->resource !== 'all') {
            return $this->resource->wps('index');
        }

        if (\Auth::user()->isAdmin() || \Auth::user()->isPartner()) {
            return Wps::query()->whereIn('company_id', \Auth::user()->companies->pluck('id'));
        }

        return null;
    }
}
