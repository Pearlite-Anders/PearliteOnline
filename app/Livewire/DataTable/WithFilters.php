<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Reactive;

trait WithFilters
{

    public $filter_columns = [];

    #[Url]
    public $filters = [];
    public $preset_filters = [];
    public $hide_filters = false;

    public $showFilterSettingsModal = false;

    public function applyFilters($query)
    {
        foreach ($this->filters as $key => $value) {
            if (!$value) {
                continue;
            }

            if($key == 'ids') {
                $query->whereIn('id', explode(',', $value));
                continue;
            }

            $column = $this->model::getColumn($key);
            if ($column->filter == 'select') {
                $query->whereJsonContains('data->' . $key, $value);

                continue;
            } elseif ($column->filter == 'search') {
                $query->where('data->' . $key, 'like', '%' . $value . '%');
                continue;
            } elseif ($column->filter == 'search_number') {
                $query->where(function ($query) use ($key, $value) {
                    $query->where('data->' . $key, 'like', '%' . $value . '%');
                    $query->orWhere(function($query) use ($key, $value) {
                        $query->where('data->' . $key, 'like', '>%');
                        $query->whereRaw('? > CAST(SUBSTRING(JSON_UNQUOTE(JSON_EXTRACT(data, "$.' . $key . '")), 2) AS SIGNED)', [$value]);
                    });

                    $query->orWhere(function($query) use ($key, $value) {
                        $query->where('data->' . $key, 'like', '<%');
                        $query->whereRaw('? < CAST(SUBSTRING(JSON_UNQUOTE(JSON_EXTRACT(data, "$.' . $key . '")), 2) AS SIGNED)', [$value]);
                    });
                });
                continue;
            } elseif ($column->filter == 'radios') {
                $query->where('data->' . $key, $value);
                continue;
            } elseif ($column->filter == 'date') {
                if(optional($value)['min'] && optional($value)['max']) {
                    if(optional($value)['min'] == optional($value)['max']) {
                        $query->where('data->' . $key, Carbon::createFromFormat('Y.m.d', $value['min'])->format('Y-m-d'));
                    } else {
                        $query->whereBetween('data->' . $key, [Carbon::createFromFormat('Y.m.d', $value['min'])->format('Y-m-d'), Carbon::createFromFormat('Y.m.d', $value['max'])->format('Y-m-d')]);
                    }
                } elseif(optional($value)['min']) {
                    $query->where('data->' . $key, '>=', Carbon::createFromFormat('Y.m.d', $value['min']));
                } elseif(optional($value)['max']) {
                    $query->where('data->' . $key, '<=', Carbon::createFromFormat('Y.m.d', $value['max']));
                }
                continue;
            } elseif ($column->filter == 'relationship') {
                $query->where($key, $value);
                continue;
            }
        }

        return $query;
    }

    public function mountWithFilters()
    {
        $this->filter_columns = auth()->user()->getFilters($this->model);
    }

    public function toggleFilterSettingsModal()
    {
        $this->showFilterSettingsModal = !$this->showFilterSettingsModal;
    }

    public function toggleFilterVisibility($columnLabel)
    {
        $this->filter_columns = $this->filter_columns->map(function ($column) use ($columnLabel) {
            if ($column->label === $columnLabel) {
                $column->visible = !$column->visible;
            }
            return $column;
        });

        $this->savefilters();
    }

    public function reorderFilters($sourceIndex, $targetIndex)
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

    public function clearFilters()
    {
        $this->filters = [];
    }
}
