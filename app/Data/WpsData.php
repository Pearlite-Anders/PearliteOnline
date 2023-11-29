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
        public ?string $standard,
        public ?string $welding_process,
        public ?string $type_of_joint,
        public ?string $throat_thickness,
        public ?string $type_of_joint_preparation,
        public ?string $plate_pipe,
        public ?string $thickness_1,
        public ?string $thickness_2,
        public ?string $material_group,
        public ?string $shielding_gas,
        public ?string $type_of_current_and_polarity,
        public ?string $filler_material_designation,
        public ?string $filler_material_size,
        public ?string $welding_position,
        public ?string $layers,
        public ?string $preheat_temperature,
        public ?string $interpass_temperature,
        public ?string $outer_pipe_diameter,
        public ?string $heat_input,
    ) {
    }
}
