<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;

trait WithFilters {

    public $filter_columns = [];

    #[Url]
    public $filters = [];

    public function mountWithFilters()
    {
        $this->filter_columns = auth()->user()->getFilters($this->model);
    }

    public function reorderfilters($sourceIndex, $targetIndex)
    {
        if ($sourceIndex === $targetIndex) {
            return;
        }

        $filter = $this->filter_columns->pull($sourceIndex);
        $this->filter_columns->splice($targetIndex, 0, [$filter]);

        $this->filter_columns = $this->filter_columns->values()->map(function ($filter, $index) {
            $filter->order = $index;
            return $filter;
        });

        $this->savefilters();
    }

    public function savefilters()
    {
        auth()->user()->saveFilters($this->model, $this->filter_columns);
    }
}
