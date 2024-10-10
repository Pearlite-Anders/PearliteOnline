<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class SupplierData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public ?string $name,
        public ?string $number,
        public ?string $services,
        public ?string $contact_name,
        public ?string $phone,
        public ?string $email,
        public ?string $critical,
        public ?string $needs_assessment,
        public ?string $assessment_frequency,
        public ?string $status,
        public ?string $remarks,
        public ?string $latest_assessment_date,
    ) {
    }
}
