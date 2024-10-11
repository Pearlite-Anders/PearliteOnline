<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Carbon;

enum Interval: string
{
    case Today = 'today';
    case Next_14_Days = '14days';
    case Next_3_Months = '3months';

    public function label()
    {
        return match ($this) {
            static::Today => _('Today'),
            static::Next_14_Days => _('Next 14 days'),
            static::Next_3_Months => _('Next 3 months'),
        };
    }

    public function date()
    {
        return match ($this) {
            static::Today => Carbon::today(),
            static::Next_14_Days => Carbon::today()->addDays(14),
            static::Next_3_Months => Carbon::today()->addMonths(3),
        };
    }
}
