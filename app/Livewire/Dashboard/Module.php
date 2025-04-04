<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

enum Module: string
{
    case Supplier = 'supplier';
    case WeldingCertificate = 'welding_certificate';
    case MachineMaintenance = 'machine_maintenance';

    public function label()
    {
        return match ($this) {
            static::Supplier => __('Supplier'),
            static::WeldingCertificate => __('Welding Certificate'),
            static::MachineMaintenance => __('Maintenance'),
        };
    }
}
