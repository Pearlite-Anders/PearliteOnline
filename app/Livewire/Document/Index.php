<?php

namespace App\Livewire\Document;

use Livewire\Component;
use App\Models\Document;
use App\Livewire\DataTable\WithTable;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\WithSearch;
use App\Livewire\DataTable\WithPerPagePagination;

class Index extends Component
{
    use WithTable, WithPerPagePagination, WithDelete, WithSearch;

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

    public function applySearch($query, $term)
    {
        $query->whereHas('currentRevision', function ($query) use ($term) {
            $query->where('data->title', 'like', '%'.$term.'%');
        });
    }

    public function getRowsQueryProperty()
    {
        $user = auth()->user();

        $query = $user->documents()->where('company_id', '=', $user->currentCompany->id)
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->with('currentRevision');

        return $query;
    }
}
