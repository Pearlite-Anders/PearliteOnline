<?php

namespace App\Livewire\DataTable;

trait WithColumns {

    public $columns = [];

    public function mountWithColumns()
    {
        $this->columns = auth()->user()->getColumns($this->model);
    }

    public function toggleColumnVisibility($columnLabel)
    {
        $this->columns = $this->columns->map(function ($column) use ($columnLabel) {
            if ($column->label === $columnLabel) {
                $column->visible = !$column->visible;
            }
            return $column;
        });

        $this->saveColumns();
    }

    public function reorderColumns($sourceIndex, $targetIndex)
    {
        if ($sourceIndex === $targetIndex) {
            return;
        }

        $column = $this->columns->pull($sourceIndex);
        $this->columns->splice($targetIndex, 0, [$column]);

        $this->columns = $this->columns->values()->map(function ($column, $index) {
            $column->order = $index;
            return $column;
        });

        $this->saveColumns();
    }

    public function saveColumns()
    {
        auth()->user()->saveColumns($this->model, $this->columns);
    }
}
