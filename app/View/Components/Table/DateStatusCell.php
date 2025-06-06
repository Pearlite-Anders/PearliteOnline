<?php

namespace App\View\Components\Table;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateStatusCell extends Component
{
    public ?Carbon $date;

    /**
     * Create a new component instance.
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $color = null;
        if ($this->date) {
            if ($this->date->isAfter(now())) {
                $color = 'bg-yellow-200';
            } else {
                $color = 'bg-red-200';
            }
        }

        return view('components.table.date-status-cell')->with('color', $color);
    }


}
