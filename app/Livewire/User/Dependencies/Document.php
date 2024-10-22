<?php

namespace App\Livewire\User\Dependencies;

use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\WithFilters;
use App\Livewire\DataTable\WithPerPagePagination;
use App\Livewire\DataTable\WithSearch;
use App\Livewire\DataTable\WithSorting;
use App\Livewire\DataTable\WithTable;

use App\Models\Document as Model;
use App\Models\User;
use Livewire\Component;

class Document extends Component
{
    use WithTable, WithPerPagePagination, WithColumns, WithSorting, WithFilters, WithDelete, WithSearch;

    public User $user;
    public $model = Model::class;


    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.dependencies.document')->with([
            'documents' => $this->rows
        ]);
    }

    public function getRowsQueryProperty()
    {

        //User->documents contains all documents the user has access to. But here we only need the ones the user owns.
        $query = $this->user->ownedDocuments();

        return $this->applySorting($query);
    }
}
