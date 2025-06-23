<?php

namespace App\Enums;

use Illuminate\Support\Carbon;

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
