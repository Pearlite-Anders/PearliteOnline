<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Reactive;

trait BaseFilters
{
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
            } elseif ($column->filter == 'checkbox') {
                $booleanValue = $value == "false" ? false : (bool)$value;
                if ($booleanValue === true) {
                    $query->where('data->' . $key, true);
                } else {
                    $query->where(function($query) use ($key) {
                        $query->where('data->' . $key, false)->orWhereNull('data->' . $key);
                    });
                }
                continue;
            } elseif ($column->filter == 'date') {
                if(optional($value)['min'] && optional($value)['max']) {
                    if(optional($value)['min'] == optional($value)['max']) {
                        $query->where('data->' . $key, $value['min']);
                    } else {
                        $query->whereBetween('data->' . $key, [$value['min'], $value['max']]);
                    }
                } elseif(optional($value)['min']) {
                    $query->where('data->' . $key, '>=', $value['min']);
                } elseif(optional($value)['max']) {
                    $query->where('data->' . $key, '<=', $value['max']);
                }
                continue;
            } elseif ($column->filter == 'relationship') {
                if(isset($column->multiple) && $column->multiple) {
                    $query->whereHas($column->relationship, function ($query) use ($key, $value) {
                        $query->whereIn('id', explode(',', $value));
                    });
                } else {
                    $query->where($key, $value);
                }
                continue;
            }
        }

        // $this->dispatch('clearSelected');

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
