<?php

namespace App\Livewire\Backoffice\ContactPerson;

use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ContactPerson;
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

    public $model = ContactPerson::class;

    public Company $company;

    public function getRowsQueryProperty()
    {

        $query = $this->company->contactpeople()
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->when($this->filters, fn ($query, $filters) => $this->applyFilters($query, $filters));

        return $this->applySorting($query);
    }

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        $this->authorize('viewAny', $this->model);

        return view('livewire.backoffice.contact-person.index')->with([
            'contactPersons' => $this->rows
        ]);
    }
}
