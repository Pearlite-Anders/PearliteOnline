<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class CeData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public ?string $year,
        public ?string $date,
        public ?string $method,
        public ?string $execution_standard,
        public ?string $execution_class,
        public ?string $standard,
        public ?string $scope,
        public ?string $tolerance_class,
        public ?array $weldability_group,
        public ?string $behavior_in_fire,
        public ?array $durability_group,
        public ?string $machining_quality,
        public ?string $surface,
        public ?string $durability,
        public ?string $dimensioning,
        public ?string $load_bearing_capacity,
        public ?string $deformation_serviceability_limit_state,
        public ?string $fatigue_strength,
        public ?string $signature,
    ) {
    }
}
