<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class RoutineInspectionData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public ?string $date,
        public ?string $execution_class,
        public ?string $drawing,
        public ?string $weld_length,
        public ?string $inspected_length,
        public ?string $inspected_scope,
        public ?array $parent_material,
        public ?string $stitch_type,
        public ?array $welding_equipment,
    ) {
    }
}
