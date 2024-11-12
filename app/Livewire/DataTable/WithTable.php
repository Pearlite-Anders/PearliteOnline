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

    #[On('selectedUpdated')]
    public function selectedUpdated($selected)
    {
        $this->selected = $selected;
    }

    public function updatedSelected()
    {
        $this->dispatch('selectedUpdated', $this->selected);
    }

    public function getRowsQueryProperty()
    {
        $relation = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->model)));

        if($this->preset_filters) {
            $this->filters = $this->preset_filters;
        }

        $query = $this->resource()
                    ->when($this->search, fn ($query, $term) => $this->applySearch($query, $term))
                    ->when($this->filters, fn ($query, $filters) => $this->applyFilters($query, $filters))
                    ->when($this->with(), fn ($query, $with) => $query->with($with))
                    ->when(isset($this->project_id), fn ($query) => $this->applyProject($query));

        return $this->applySorting($query);
    }


    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function resource()
    {
        $relation = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->model)));

        return auth()->user()->currentCompany->{$relation}('index');
    }

    public function with(): ?array
    {
        return null;
    }

    protected function applyProject($query)
    {
        return $query->whereHas('projects', (fn ($query) => $query->where('id', '=',$this->project_id)));
    }
}
