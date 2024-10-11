<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Carbon;

enum Module: string
{
    case Supplier = 'supplier';
    case WeldingCertificate = 'welding_certificate';
    case MachineMaintenance = 'machine_maintenance';

    public function label()
    {
        return match ($this) {
            static::Supplier => _('Supplier'),
            static::WeldingCertificate => _('Welding Certificate'),
            static::MachineMaintenance => _('Maintenance'),
        };
    }
}
