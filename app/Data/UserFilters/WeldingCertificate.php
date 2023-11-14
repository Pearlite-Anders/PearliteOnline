<?php
namespace App\Data\UserFilters;

use Spatie\LaravelData\Data;

class WeldingCertificate extends Data
{
    public function __construct(
        public array $columns = [
            'number',
            'designation',
            'welding_process',
            'plate_pipe',
            'type_of_weld',
            'material_group',
            'filler_material_type',
            'filler_material_group',
            'filler_material_designation',
            'shielding_gas',
            'type_of_current_and_polarity',
            'material_thickness',
            'deposited_thickness',
            'outside_pip_diameter',
            'welding_position',
            'weld_details',
            'date_examination',
            'last_signature',
        ],

    ) {
    }
}
