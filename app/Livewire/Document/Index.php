<?php

namespace App\Livewire\Document;

use Livewire\Component;
use App\Models\Document;
use App\Livewire\DataTable\WithTable;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\WithSearch;
use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\WithFilters;
use App\Livewire\DataTable\WithSorting;
// use App\Livewire\DataTable\WithClickableRow;
use App\Livewire\DataTable\WithPerPagePagination;
// use App\Livewire\DataTable\WithProject;

class Index extends Component
{
    use WithTable, WithPerPagePagination, WithSorting, WithColumns, WithFilters, WithDelete, WithSearch;

    public $model = Document::class;
    public $compressed_header = false;
    public $attach_project = false;

    public function mount()
    {
        abort_unless(auth()->user()->can('viewAny', Document::class), 403);
    }

    public function render()
    {
        return view('livewire.document.index')->with([
            'documents' => $this->rows
        ]);;
    }

    public function getRowsQueryProperty()
    {
        $user = auth()->user();

        if($this->preset_filters) {
            $this->filters = $this->preset_filters;
        }

        $query = $user->documents()->where('company_id', '=', $user->currentCompany->id)
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->when($this->filters, fn ($query, $filters) => $this->applyFilters($query, $filters));

        return $this->applySorting($query);
    }
}
