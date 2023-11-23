<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Livewire\Shared\Datagrid;
use Livewire\Attributes\Reactive;
use App\Models\WeldingCertificate;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\WithSearch;
use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\WithFilters;
use App\Livewire\DataTable\WithSorting;
use App\Livewire\DataTable\WithClickableRow;
use App\Livewire\DataTable\WithPerPagePagination;

class Index extends Component
{
    use WithPerPagePagination, WithSorting, WithColumns, WithFilters, WithDelete, WithSearch, WithClickableRow;

    public $model = WeldingCertificate::class;

    public function getRowsQueryProperty()
    {
        $query = auth()->user()->currentCompany->welding_certificates()
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->when($this->filters, fn ($query, $filters) => $this->applyFilters($query, $filters));

        return $this->applySorting($query);
    }


    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        $this->authorize('viewAny', WeldingCertificate::class);

        return view('livewire.welding-certificates.index')->with([
            'weldingCertificates' => $this->rows
        ]);
    }
}
