<?php

namespace App\Livewire\DataTable;

use Illuminate\Support\Str;
use Livewire\Attributes\On;

trait WithTable
{
    public $selected = [];

    #[On('clearSelected')]
    public function clearSelected()
    {
        $this->selected = [];
    }

    public function getRowsQueryProperty()
    {
        $relation = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->model)));

        if($this->preset_filters) {
            $this->filters = $this->preset_filters;
        }

        $query = auth()->user()->currentCompany->{$relation}('index')
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->when($this->filters, fn ($query, $filters) => $this->applyFilters($query, $filters));

        return $this->applySorting($query);
    }


    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }
}
