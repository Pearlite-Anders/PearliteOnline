<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Carbon;

enum Module: string
{
    case Supplier = 'supplier';

    public function label()
    {
        return match ($this) {
            static::Supplier => _('Supplier'),
        };
    }
}
