<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class TimeRegistrationData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public ?string $date,
        public ?int $hours,
        public ?int $driving,
        public ?int $expenses,
        public ?string $remarks,
        public ?string $type,
        public ?bool $invoiced,
        public ?bool $paid,
        public ?array $tasks,
    ) {
    }
}
