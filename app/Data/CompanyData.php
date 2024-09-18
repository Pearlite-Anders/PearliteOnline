<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class CompanyData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string $name,
        public ?string $road,
        public ?string $phone,
        public ?string $email,
        public ?string $invoice_email,
        public ?int $driving,
        public ?string $remarks,
    ) {
    }
}
