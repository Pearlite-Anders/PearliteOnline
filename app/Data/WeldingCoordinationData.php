<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class WeldingCoordinationData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public ?string $purpose,
        public ?string $date,
        public ?string $activity,
    ) {
    }
}
