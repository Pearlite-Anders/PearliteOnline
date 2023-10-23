<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeldingCertificate>
 */
class WeldingCertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => '123456',
            'welder_id' => 1,
            'designation' => 'Test Designation',
            'welding_process' => 'Test Welding Process',
            'plate_pipe' => 'Test Plate or Pipe',
            'type_of_weld' => 'Test Type of Weld',
            'material_group' => 'Test Material Group',
            'filler_material_type' => 'Test Filler Material Type',
            'filler_material_group' => 'Test Filler Material Group',
            'filler_material_designation' => 'Test Filler Material Designation',
            'shielding_gas' => 'Test Shielding Gas',
            'type_of_current_and_polarity' => 'Test Type of Current and Polarity',
            'material_thickness' => 'Test Material Thickness',
            'deposited_thickness' => 'Test Deposited Thickness',
            'outside_pip_diameter' => 'Test Outside Pip Diameter',
            'welding_position' => 'Test Welding Position',
            'weld_details' => 'Test Weld Details',
            'date_examination' => '2021-01-01',
        ];
    }
}
