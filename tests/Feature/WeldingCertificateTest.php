<?php

use App\Models\File;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Company;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\UploadedFile;
use App\Models\WeldingCertificate;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

test('certificates is visible in menu if user has access', function () {
    $this->actingAs(User::factory()->withCurrentCompany()->create()->givePermissionTo('welding-certificates.view'));
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
    $response->assertSee(route('welding-certificates.index'));
});

test('certificates is not visible in menu if user doesnt has access', function () {
    $this->actingAs(User::factory()->withCurrentCompany()->create());
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
    $response->assertDontSee(route('welding-certificates.index'));
});


test('certificate index can be rendered for user with access', function () {
    $this->actingAs(User::factory()->withCurrentCompany()->create()->givePermissionTo('welding-certificates.view'));
    $response = $this->get(route('welding-certificates.index'));
    $response->assertStatus(200);
});

test('certificate index cannot be rendered for user without access', function () {
    $this->actingAs(User::factory()->withCurrentCompany()->create());
    $response = $this->get(route('welding-certificates.index'));
    $response->assertStatus(403);
});

test('new certificate can be created', function () {
    $this->actingAs($user = User::factory()->withCurrentCompany()->create()->givePermissionTo('welding-certificates.edit'));

    Livewire::test(App\Livewire\WeldingCertificates\Create::class)
        ->set([
            'form' => [
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
                'date_examination' => '2021.01.01',
            ]
        ])
        ->assertSet('form.number', '123456')
        ->assertSet('form.welder_id', 1)
        ->assertSet('form.designation', 'Test Designation')
        ->assertSet('form.welding_process', 'Test Welding Process')
        ->assertSet('form.plate_pipe', 'Test Plate or Pipe')
        ->assertSet('form.type_of_weld', 'Test Type of Weld')
        ->assertSet('form.material_group', 'Test Material Group')
        ->assertSet('form.filler_material_type', 'Test Filler Material Type')
        ->assertSet('form.filler_material_group', 'Test Filler Material Group')
        ->assertSet('form.filler_material_designation', 'Test Filler Material Designation')
        ->assertSet('form.shielding_gas', 'Test Shielding Gas')
        ->assertSet('form.type_of_current_and_polarity', 'Test Type of Current and Polarity')
        ->assertSet('form.material_thickness', 'Test Material Thickness')
        ->assertSet('form.deposited_thickness', 'Test Deposited Thickness')
        ->assertSet('form.outside_pip_diameter', 'Test Outside Pip Diameter')
        ->assertSet('form.welding_position', 'Test Welding Position')
        ->assertSet('form.weld_details', 'Test Weld Details')
        ->assertSet('form.date_examination', '2021.01.01')
        ->call('create');

    $welding_certificate = $user->currentCompany->welding_certificates()->with('meta')->first();

    expect($welding_certificate->number)->toBe('123456');
    expect($welding_certificate->welder_id)->toBe(1);
    expect($welding_certificate->designation)->toBe('Test Designation');
    expect($welding_certificate->welding_process)->toBe('Test Welding Process');
    expect($welding_certificate->plate_pipe)->toBe('Test Plate or Pipe');
    expect($welding_certificate->type_of_weld)->toBe('Test Type of Weld');
    expect($welding_certificate->material_group)->toBe('Test Material Group');
    expect($welding_certificate->filler_material_type)->toBe('Test Filler Material Type');
    expect($welding_certificate->filler_material_group)->toBe('Test Filler Material Group');
    expect($welding_certificate->filler_material_designation)->toBe('Test Filler Material Designation');
    expect($welding_certificate->shielding_gas)->toBe('Test Shielding Gas');
    expect($welding_certificate->type_of_current_and_polarity)->toBe('Test Type of Current and Polarity');
    expect($welding_certificate->material_thickness)->toBe('Test Material Thickness');
    expect($welding_certificate->deposited_thickness)->toBe('Test Deposited Thickness');
    expect($welding_certificate->outside_pip_diameter)->toBe('Test Outside Pip Diameter');
    expect($welding_certificate->welding_position)->toBe('Test Welding Position');
    expect($welding_certificate->weld_details)->toBe('Test Weld Details');
    expect($welding_certificate->date_examination->format('Y.m.d'))->toBe('2021.01.01');
});

test('certificate can be edited', function () {
    $this->actingAs($user = User::factory()->withCurrentCompany()->create()->givePermissionTo('welding-certificates.edit'));

    $welding_certificate = WeldingCertificate::factory()->create([
        'company_id' => $user->currentCompany->id,
    ])->load('meta');


    Livewire::test(App\Livewire\WeldingCertificates\Edit::class, ['weldingCertificate' => $welding_certificate])
        ->set([
            'form' => [
                'number' => '654321',
                'welder_id' => 2,
                'designation' => 'Test Designation 2',
                'welding_process' => 'Test Welding Process 2',
                'plate_pipe' => 'Test Plate or Pipe 2',
                'type_of_weld' => 'Test Type of Weld 2',
                'material_group' => 'Test Material Group 2',
                'filler_material_type' => 'Test Filler Material Type 2',
                'filler_material_group' => 'Test Filler Material Group 2',
                'filler_material_designation' => 'Test Filler Material Designation 2',
                'shielding_gas' => 'Test Shielding Gas 2',
                'type_of_current_and_polarity' => 'Test Type of Current and Polarity 2',
                'material_thickness' => 'Test Material Thickness 2',
                'deposited_thickness' => 'Test Deposited Thickness 2',
                'outside_pip_diameter' => 'Test Outside Pip Diameter 2',
                'welding_position' => 'Test Welding Position 2',
                'weld_details' => 'Test Weld Details 2',
                'date_examination' => '2021.02.02',
            ]
        ])
        ->assertSet('form.number', '654321')
        ->assertSet('form.welder_id', 2)
        ->assertSet('form.designation', 'Test Designation 2')
        ->assertSet('form.welding_process', 'Test Welding Process 2')
        ->assertSet('form.plate_pipe', 'Test Plate or Pipe 2')
        ->assertSet('form.type_of_weld', 'Test Type of Weld 2')
        ->assertSet('form.material_group', 'Test Material Group 2')
        ->assertSet('form.filler_material_type', 'Test Filler Material Type 2')
        ->assertSet('form.filler_material_group', 'Test Filler Material Group 2')
        ->assertSet('form.filler_material_designation', 'Test Filler Material Designation 2')
        ->assertSet('form.shielding_gas', 'Test Shielding Gas 2')
        ->assertSet('form.type_of_current_and_polarity', 'Test Type of Current and Polarity 2')
        ->assertSet('form.material_thickness', 'Test Material Thickness 2')
        ->assertSet('form.deposited_thickness', 'Test Deposited Thickness 2')
        ->assertSet('form.outside_pip_diameter', 'Test Outside Pip Diameter 2')
        ->assertSet('form.welding_position', 'Test Welding Position 2')
        ->assertSet('form.weld_details', 'Test Weld Details 2')
        ->assertSet('form.date_examination', '2021.02.02')
        ->call('update');

    $welding_certificate = $user->currentCompany->welding_certificates()->with('meta')->first();

    expect($welding_certificate->number)->toBe('654321');
    expect($welding_certificate->welder_id)->toBe(2);
    expect($welding_certificate->designation)->toBe('Test Designation 2');
    expect($welding_certificate->welding_process)->toBe('Test Welding Process 2');
    expect($welding_certificate->plate_pipe)->toBe('Test Plate or Pipe 2');
    expect($welding_certificate->type_of_weld)->toBe('Test Type of Weld 2');
    expect($welding_certificate->material_group)->toBe('Test Material Group 2');
    expect($welding_certificate->filler_material_type)->toBe('Test Filler Material Type 2');
    expect($welding_certificate->filler_material_group)->toBe('Test Filler Material Group 2');
    expect($welding_certificate->filler_material_designation)->toBe('Test Filler Material Designation 2');
    expect($welding_certificate->shielding_gas)->toBe('Test Shielding Gas 2');
    expect($welding_certificate->type_of_current_and_polarity)->toBe('Test Type of Current and Polarity 2');
    expect($welding_certificate->material_thickness)->toBe('Test Material Thickness 2');
    expect($welding_certificate->deposited_thickness)->toBe('Test Deposited Thickness 2');
    expect($welding_certificate->outside_pip_diameter)->toBe('Test Outside Pip Diameter 2');
    expect($welding_certificate->welding_position)->toBe('Test Welding Position 2');
    expect($welding_certificate->weld_details)->toBe('Test Weld Details 2');
    expect($welding_certificate->date_examination->format('Y.m.d'))->toBe('2021.02.02');
});

test('certificate expire date is calculated correct', function () {
    $this->actingAs($user = User::factory()->withCurrentCompany()->create()->givePermissionTo('welding-certificates.edit'));

    $welding_certificate = WeldingCertificate::factory()->create([
        'company_id' => $user->currentCompany->id,
    ])->load('meta');

    $welding_certificate = $user->currentCompany->welding_certificates()->with('meta')->first();
    expect($welding_certificate->date_expiration)->toBe($welding_certificate->date_examination->addYears(3)->format('Y.m.d'));
});

test('new certificate pdf will be save upon creating', function () {
    Storage::fake('s3');
    $file = UploadedFile::fake()->create('certificate.pdf', 1000, 'application/pdf');

    $this->actingAs($user = User::factory()->withCurrentCompany()->create()->givePermissionTo('welding-certificates.edit'));

    Livewire::test(App\Livewire\WeldingCertificates\Create::class)
        ->set([
            'form' => [
                'number' => '123456',
                'welder_id' => 1,
            ]
        ])
        ->set('form.new_certificate', $file)
        ->call('create');

    $welding_certificate = $user->currentCompany->welding_certificates()->with('meta')->first();
    expect($welding_certificate->current_certificate)->toBe(1);
    $file = File::find($welding_certificate->current_certificate);
    Storage::disk('s3')->assertExists($file->path);
});
