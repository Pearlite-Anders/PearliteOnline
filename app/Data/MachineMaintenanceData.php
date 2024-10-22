<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class MachineMaintenanceData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string $name,
        public ?string $type,
        public ?string $make,
        public ?string $serial_number,
        public ?string $internal_number,
        public ?string $maintenance_interval,
        public ?string $lastest_maintenance_date,
        public ?string $next_maintenance_date,
        public ?string $status,
        public ?string $brand,
    ) {
    }
}
