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
}
