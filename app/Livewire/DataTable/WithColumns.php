<?php

namespace App\Livewire\DataTable;

trait WithColumns
{
    protected bool $backendColumns = false;
    public $columns = [];

    public function mountWithColumns()
    {
        $columns = auth()->user()->getColumns($this->model);

        if (!$this->backendColumns) {
            $columns = $columns->filter(function ($column) {
                return $column->key !== 'company';
            });
        }

        $this->columns = $columns->map(function ($column) {
            $column->label = __($column->label);
            return $column;
        });
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
