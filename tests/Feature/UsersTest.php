<?php

use App\Models\User;
use Livewire\Livewire;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

test('confirm users can be rendered', function () {
    $user = User::factory()->create()->givePermissionTo('users.view');
    $response = $this->actingAs($user)->get(route('users.index'));
    $response->assertStatus(200);
});

test('confirm users without users.view cannot see page', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get(route('users.index'));
    $response->assertStatus(403);
});

test('admin can create a user', function () {
    $this->actingAs($user = User::factory([
        'role' => USER::ADMIN_ROLE,
    ])->withCurrentCompany()->create());

    Livewire::test(App\Livewire\User\Create::class)
        ->set(
            [
                'form.name' => 'Test User',
                'form.email' => 'test@test.com',
                'form.password' => '123456',
                'form.role' => User::USER_ROLE
            ]
        )
        ->assertSet('form.name', 'Test User')
        ->assertSet('form.email', 'test@test.com')
        ->assertSet('form.password', '123456')
        ->assertSet('form.role', User::USER_ROLE)
        ->call('create');

    $user = User::where('email', 'test@test.com')->first();
    expect($user->name)->toBe('Test User');
    expect($user->role)->toBe(User::USER_ROLE);
});

test('admin see all users', function () {
    $this->actingAs(User::factory([
        'role' => 'admin',
    ])->create());

    $user = User::factory()->create();

    $this->get(route('users.index'))
        ->assertSuccessful()
        ->assertSee($user->name);
});

test('admin can update a user', function () {
    $this->actingAs($user = User::factory([
        'role' => 'admin',
    ])->withCurrentCompany()->create());

    $userToUpdate = User::factory()->create();

    Livewire::test(App\Livewire\User\Edit::class, ['user' => $userToUpdate])
            ->set(
                [
                    'form.name' => 'Test User',
                    'form.email' => 'test@test.com',
                    'form.password' => '123456',
                    'form.role' => User::PARTNER_ROLE
                ]
            )
            ->assertSet('form.name', 'Test User')
            ->assertSet('form.email', 'test@test.com')
            ->assertSet('form.password', '123456')
            ->assertSet('form.role', User::PARTNER_ROLE)
            ->call('update');

    $userToUpdate->refresh();
    expect($userToUpdate->name)->toBe('Test User');
    expect($userToUpdate->email)->toBe('test@test.com');
    expect($userToUpdate->role)->toBe(User::PARTNER_ROLE);
    expect(Hash::check('123456', $userToUpdate->password))->toBeTrue();
});

test('admin can see the option to make a user Partner or Admin', function () {
    $this->actingAs(User::factory([
        'role' => User::ADMIN_ROLE,
    ])->create());

    $user = User::factory()->create();

    $this->get(route('users.edit', $user))
        ->assertSuccessful()
        ->assertSee('Partner')
        ->assertSee('Admin');
});

test('partner cannot see the option to make a user Partner or Admin', function () {
    $this->actingAs(User::factory([
        'role' => User::PARTNER_ROLE,
    ])->create()->givePermissionTo('users.edit'));

    $user = User::factory()->create();

    $this->get(route('users.edit', $user))
        ->assertSuccessful()
        ->assertDontSee('Partner')
        ->assertDontSee('Admin')
        ->assertDontSee('Role');
});

test('user cannot see the option to make a user Partner or Admin', function () {
    $currentUser = User::factory([
        'role' => User::USER_ROLE,
    ])->create();
    $currentUser->givePermissionTo('users.edit');
    $this->actingAs($currentUser);

    $user = User::factory()->create();

    $this->get(route('users.edit', $user))
        ->assertSuccessful()
        ->assertDontSee('Partner')
        ->assertDontSee('Admin')
        ->assertDontSee('Role');
});

test('user cannot save a new role', function () {
    $this->actingAs(User::factory([
        'role' => User::USER_ROLE,
    ])->withCurrentCompany()->create()->givePermissionTo('users.edit'));

    $userToUpdate = User::factory()->create();

    Livewire::test(App\Livewire\User\Edit::class, ['user' => $userToUpdate])
            ->set(
                [
                    'form.role' => User::PARTNER_ROLE
                ]
            )
            ->assertSet('form.role', User::PARTNER_ROLE)
            ->call('update');

    $userToUpdate->refresh();
    expect($userToUpdate->role)->not()->toBe(User::PARTNER_ROLE);
});

test('user cannot see admins', function () {
    $this->actingAs(User::factory([
        'role' => User::USER_ROLE,
    ])->withCurrentCompany()->create()->givePermissionTo('users.view'));

    $admin = User::factory()->create([
        'role' => User::ADMIN_ROLE
    ]);

    $this->get(route('users.index'))
        ->assertSuccessful()
        ->assertDontSee($admin->name);
});

test('user can see other users in company', function () {
    $this->actingAs(User::factory([
        'role' => USER::USER_ROLE,
    ])->withCurrentCompany()->create()->givePermissionTo('users.view'));

    $user = User::factory()->create([
        'role' => User::USER_ROLE,
        'current_company_id' => auth()->user()->currentCompany->id
    ]);
    auth()->user()->currentCompany->users()->attach($user);

    $this->get(route('users.index'))
        ->assertSuccessful()
        ->assertSee($user->name);
});

test('user cannot see user from other company', function () {
    $this->actingAs($admin = User::factory([
        'role' => USER::USER_ROLE,
    ])->withCurrentCompany()->create()->givePermissionTo('users.view'));

    $company_2 = Company::factory()->create();

    $user = User::factory()->create([
        'role' => User::USER_ROLE,
        'current_company_id' => $company_2->id
    ]);
    $company_2->users()->attach($user);

    $this->get(route('users.index'))
        ->assertSuccessful()
        ->assertDontSee($user->name);
});

// test('user with permission to edit can delete a user', fuu)
