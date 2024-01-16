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
        public ?string $method,
        public ?string $execution_standard,
        public ?string $execution_class,
        public ?string $standard,
        public ?string $scope,
        public ?string $tolerance_class,
        public ?array $weldability,
        public ?array $technical_delivery_conditions,
        public ?array $fracture_toughness,
        public ?string $behavior_in_fire,
        public ?string $machining_quality,
        public ?string $durability,
        public ?string $load_bearing_capacity,
        public ?string $manufacturing,
    ) {
    }
}
