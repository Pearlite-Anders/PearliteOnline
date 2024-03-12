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
use App\Livewire\DataTable\WithTable;
use App\Models\Welder;

class Index extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, WithColumns, WithFilters, WithDelete, WithSearch, WithClickableRow;

    public $model = WeldingCertificate::class;

    public function render()
    {
        $this->authorize('viewAny', WeldingCertificate::class);
        return view('livewire.welding-certificates.index')->with([
            'weldingCertificates' => $this->rows
        ]);
    }
}
