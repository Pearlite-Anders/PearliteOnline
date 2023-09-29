<?php

use App\Models\User;
use Livewire\Livewire;
use App\Models\Company;
use function Pest\Laravel\get;
use Laravel\Jetstream\Http\Livewire\CreateTeamForm;

test('companies can be created', function () {
    $this->actingAs($user = User::factory([
        'role' => 'admin',
    ])->create());

    Livewire::test(App\Livewire\Company\Create::class)
        ->set('form.name', 'Test Company')
        ->assertSet('form.name', 'Test Company')
        ->call('create');

    expect($user->fresh()->companies)->toHaveCount(1);
    expect($user->fresh()->companies()->latest('id')->first()->name)->toEqual('Test Company');
});

test('company create page is rendered', function () {
    $this->actingAs(User::factory([
        'role' => 'admin',
    ])->create());

    get(route('companies.create'))->assertSeeLivewire('company.create');
});

test('only admins can create companies', function () {
    $this->actingAs(User::factory()->create());
    Livewire::test(App\Livewire\Company\Create::class)->assertForbidden();
});

test('only admin or partner can see companies page', function () {
    $this->actingAs(User::factory()->create());
    Livewire::test(App\Livewire\Company\Index::class)->assertForbidden();

    get(route('companies.index'))->assertForbidden();
});

test('only admin and partners see the companies icon', function () {
    $this->actingAs(User::factory()->create());
    get(route('dashboard'))->assertDontSee(route('companies.index'));
    $this->app->get('auth')->forgetGuards();


    $this->actingAs(User::factory([
        'role' => User::PARTNER_ROLE,
    ])->create());
    get(route('dashboard'))->assertSee(route('companies.index'));


    $this->actingAs(User::factory([
        'role' => 'admin',
    ])->create());
    get(route('dashboard'))->assertSee(route('companies.index'));
});

test('admin can see all companies', function () {
    $this->actingAs(User::factory([
        'role' => 'admin',
    ])->create());

    $company_1 = Company::factory()->create();
    $company_2 = Company::factory()->create();


    Livewire::test(App\Livewire\Company\Index::class)
        ->assertSee($company_1->name)
        ->assertSee($company_2->name);
});

test('admin can update a company', function () {
    $this->actingAs($user = User::factory([
        'role' => 'admin',
    ])->create());

    $company = Company::factory()->create();

    Livewire::test(App\Livewire\Company\Edit::class, ['company' => $company])
        ->set('form.name', 'Test Company')
        ->assertSet('form.name', 'Test Company')
        ->call('update');

    expect($user->fresh()->companies()->latest('id')->first()->name)->toEqual('Test Company');
});

test('partner cannot update a company', function () {
    $this->actingAs($user = User::factory([
        'role' => 'partner',
    ])->create());

    $company = Company::factory()->create();

    Livewire::test(App\Livewire\Company\Edit::class, ['company' => $company])
        ->assertForbidden();
});

test('admin can switch to a company', function () {
    $this->actingAs($user = User::factory([
        'role' => 'admin',
    ])->create());

    expect($user->currentCompany)->toBeNull();
    $company = Company::factory()->create();
    get(route('switch-company', ['company' => $company]));
    expect($user->refresh()->currentCompany->id)->toEqual($company->id);
});

test('partner can switch to a company', function () {
    $this->actingAs($user = User::factory([
        'role' => 'partner',
    ])->create());

    expect($user->currentCompany)->toBeNull();
    $company = Company::factory()->create();
    $company->users()->attach($user);
    get(route('switch-company', ['company' => $company]));
    expect($user->refresh()->currentCompany->id)->toEqual($company->id);
});

test('partner can switch to a company his is not part of', function () {
    $this->actingAs($user = User::factory([
        'role' => 'partner',
    ])->create());

    expect($user->currentCompany)->toBeNull();
    $company = Company::factory()->create();
    get(route('switch-company', ['company' => $company]));
    expect($user->currentCompany)->toBeNull();
});

test('if user has current company it is show in header', function () {
    $this->actingAs($user = User::factory([
        'role' => 'admin',
    ])->create());

    $company = Company::factory()->create();
    get(route('dashboard'))->assertDontSee($company->name);

    $user->currentCompany()->associate($company);
    $user->save();

    get(route('dashboard'))->assertSee($company->name);
});
