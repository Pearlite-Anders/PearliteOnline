<?php

namespace App\Models\Trait;

use App\Models\File;
use Illuminate\Support\Carbon;

trait HasFilter
{

    public static function getDefaultColumns()
    {
        $order = 0;
        return collect(self::SYSTEM_COLUMNS)->map(function ($column, $index) use (&$order) {
            return (object)[
                'key' => $index,
                'label' => $column['label'],
                'visible' => true,
                'order' => $order++,
            ];
        })->values();
    }

    public static function getColumns()
    {
        return collect(self::SYSTEM_COLUMNS)->map(function ($column, $index){
            $column['key'] = $index;
            return $column;
        });
    }

    public static function getColumn($key)
    {
        $column =  (object)self::SYSTEM_COLUMNS[$key];
        $column->key = $key;
        return $column;
    }

    public static function getDefaultFilters()
    {
        $order = 0;
        return collect(self::SYSTEM_COLUMNS)
            ->filter(function ($column) {
                return optional($column)['filter'];
            })
            ->map(function ($column, $index) use (&$order) {
                return (object)[
                    'key' => $index,
                    'label' => $column['label'],
                    'visible' => true,
                    'order' => $order++,
                ];
            })->values();
    }

    public function getColumnValue($column_key, $formatting = true)
    {
        $column = self::getColumn($column_key);
        $value = '';

        if($column->type == 'relationship') {
            if(preg_match('/\./', $column->class::LABEL_KEY)) {
                $keys = explode('.', $column->class::LABEL_KEY);
                $value = optional(optional($this->{$column->relationship})->{$keys[0]})[$keys[1]];
            } else {
                $value = $this->{$column->relationship} ? $this->{$column->relationship}->{ $column->class::LABEL_KEY } : '';
            }
        } elseif($column->type == 'calculated') {
            $value = optional($this)->{$column_key};
        } elseif($column->type == 'select') {
            $options = is_array($column->options) ? $column->options : \App\Models\Setting::get($column->options);
            if(is_array(optional($this->data)[$column_key])) {
                $value = [];
                foreach($this->data[$column_key] as $key => $val) {
                    $value[$key] = optional($options)[$val];
                }

                $value = implode(', ', $value);
            } elseif(optional($this->data)[$column_key]) {
                $value = optional($options)[$this->data[$column_key]];
            }
        } elseif($column->type == 'radios') {
            if(is_array($column->options) && optional($this->data)[$column_key]) {
                $value = optional($column->options)[optional($this->data)[$column_key]];
            }
        } elseif($column->type == 'date') {
            if(preg_match('/^\d{4}-\d{2}-\d{2}$/', optional($this->data)[$column_key])) {
                $value = Carbon::parse(optional($this->data)[$column_key])->format('Y.m.d');
            } else {
                $value = optional($this->data)[$column_key];
            }
        } elseif($column->type == 'welding_certificate') {
            if($this->current_file_id) {
                $file = File::find($this->current_file_id);
                $value = $file->temporary_url();
            }
        } else {
            $value = optional($this->data)[$column_key];
        }

        if(!$formatting) {
            return $value;
        }

        $value = __($value);

        if(optional($column)->prefix && $value) {
            $value = __($column->prefix) . $value;
        }

        if(optional($column)->postfix && $value) {
            $value = $value . __($column->postfix);
        }

        if($column->type == 'welding_certificate' && $value) {
            return '<a href="' . $value . '" target="_blank">' . __('Download') . '</a>';
        }

        return $value;
    }

    public function toArray()
    {
        return collect(self::getDefaultColumns())->mapWithKeys(function ($column) {
            $value = $this->getColumnValue($column->key);
            return [__($column->label) => $value];
        })->toArray();
    }
}
