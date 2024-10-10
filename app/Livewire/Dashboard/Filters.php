<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Url;
use Livewire\Form;

class Filters extends Form
{
    #[Url]
    public Interval $interval = Interval::Today;

    #[Url]
    public $modules = [];

    public function init()
    {
        if (empty($this->modules)) {
            $this->modules = array_map(fn($module) => $module->value, Module::cases());
        }
    }

    public function apply($query, Module $module)
    {
        $query = $this->applyModule($query, $module);
        return $query;
    }

    protected function applyModule($query, Module $module)
    {
        $query = $query->whereRaw(
            "DATE_ADD(JSON_UNQUOTE(JSON_EXTRACT(data, '$.latest_assessment_date')), INTERVAL JSON_UNQUOTE(JSON_EXTRACT(data, '$.assessment_frequency')) MONTH) <= ?",
            [$this->interval->date()]
        );

        $query = $query->where('data->needs_assessment', '!=', "no");

        return $query;
    }
}
