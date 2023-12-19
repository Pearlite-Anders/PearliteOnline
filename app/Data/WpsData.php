<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;

class WpsData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string $number,
        public ?array $standard,
        public ?array $welding_process,
        public ?array $type_of_joint,
        public ?string $throat_thickness,
        public ?array $type_of_joint_preparation,
        public ?array $plate_pipe,
        public ?string $thickness_1,
        public ?string $thickness_2,
        public ?array $material_group,
        public ?array $shielding_gas,
        public ?array $type_of_current_and_polarity,
        public ?string $filler_material_designation,
        public ?string $filler_material_size,
        public ?array $welding_position,
        public ?array $layers,
        public ?string $preheat_temperature,
        public ?string $interpass_temperature,
        public ?string $outer_pipe_diameter,
        public ?string $heat_input,
    ) {
    }
}
