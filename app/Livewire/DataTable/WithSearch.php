<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Url;

trait WithSearch
{

    #[Url]
    public $search = '';

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
                        if(preg_match('/\./', $column->class::LABEL_KEY)) {
                            $relation_column = str_replace('.', '->', $column->class::LABEL_KEY);
                            $query->where($relation_column, 'like', '%'.$term.'%');
                        } else {
                            $query->where($column->class::LABEL_KEY, 'like', '%'.$term.'%');
                        }
                    });
                    continue;
                }
            }
        });
    }
}
