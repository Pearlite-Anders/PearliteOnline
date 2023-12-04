<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class WeldingCertificateData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string $number,
        public ?string $designation,
        public ?array $welding_process,
        public ?array $plate_pipe,
        public ?array $type_of_weld,
        public ?array $material_group,
        public ?array $filler_material_type,
        public ?array $filler_material_group,
        public ?string $filler_material_designation,
        public ?array $shielding_gas,
        public ?array $type_of_current_and_polarity,
        public ?string $material_thickness,
        public ?string $deposited_thickness,
        public ?string $outside_pip_diameter,
        public ?array $welding_position,
        public ?string $weld_details,
        public ?string $date_examination,
        public ?string $last_signature,
        public ?array $signature_boxes,
        public ?string $signed,
        public ?string $max_signatures
    ) {
    }
}
