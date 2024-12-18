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

        $query = $this->resource()->{$relation}('index')
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->when($this->filters, fn ($query, $filters) => $this->applyFilters($query, $filters))
                    ->when($this->with(), fn ($query, $with) => $query->with($with));

        return $this->applySorting($query);
    }


    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function resource()
    {
        return auth()->user()->currentCompany;
    }

    public function with(): ?array
    {
        return null;
    }
}
