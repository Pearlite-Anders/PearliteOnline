<?php

namespace App\Models\Trait;


Trait HasFilter
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
}
