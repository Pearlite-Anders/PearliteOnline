<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Url;

trait BaseSearch
{
    public function applySearch($query, $term)
    {
        $query->where(function ($query) use ($term) {
            foreach($this->columns as $column) {
                $column = $this->model::getColumn($column->key);

                if($column->type == 'text') {
                    $query->orWhere('data->'. $column->key, 'like', '%'.$term.'%');
                    continue;
                }

                if($column->type == 'select') {
                    $term = str_replace('.', '-', $term);
                    $query->orWhere('data->'. $column->key, 'like', '%'.$term.'%');
                    continue;
                }

                if($column->type == 'date') {
                    $query->orWhere('data->'. $column->key, 'like', '%'.$term.'%');
                    continue;
                }

                if($column->type == 'relationship') {
                    $query->orWhereHas($column->relationship, function ($query) use ($term, $column) {
                        $label_keys = is_array($column->class::LABEL_KEY) ? $column->class::LABEL_KEY : [$column->class::LABEL_KEY];
                        $query->where(function ($query) use ($term, $label_keys) {
                            foreach($label_keys as $label_key) {
                                if(preg_match('/\./', $label_key)) {
                                    $relation_column = str_replace('.', '->', $label_key);
                                    $query->orWhere($relation_column, 'like', '%'.$term.'%');
                                } else {
                                    $query->orWhere($label_key, 'like', '%'.$term.'%');
                                }
                            }

                        });
                    });
                    continue;
                }
            }
        });
    }
}
