<?php

namespace Tests\Feature;

use App\Models\User;
use Livewire\Livewire;

test('confirm system users can be rendered for admins', function () {
    $user = User::factory([
        'role' => User::ADMIN_ROLE,
    ])->create();
    $response = $this->actingAs($user)->get(route('system-users.index'));
    $response->assertStatus(200);
});

test('confirm system users cannot be rendered for none admins', function () {
    $user = User::factory([
        'role' => User::PARTNER_ROLE,
    ])->create();
    $response = $this->actingAs($user)->get(route('system-users.index'));
    $response->assertStatus(403);

    $user = User::factory([
        'role' => User::USER_ROLE,
    ])->create();
    $response = $this->actingAs($user)->get(route('system-users.index'));
    $response->assertStatus(403);
});

test('admin can create a system-user', function () {
    $this->actingAs($user = User::factory([
        'role' => USER::ADMIN_ROLE,
    ])->withCurrentCompany()->create());

    Livewire::test(App\Livewire\SystemUser\Create::class)
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
        ->call('create');

    $user = User::where('email', 'test@test.com')->first();
    expect($user->name)->toBe('Test User');
    expect($user->role)->toBe(User::PARTNER_ROLE);
});

test('sees all system users', function () {
    $this->actingAs(User::factory([
        'role' => 'admin',
    ])->create());

    $user = User::factory([
        'role' => User::PARTNER_ROLE,
    ])->create();

    $this->get(route('system-users.index'))
        ->assertSuccessful()
        ->assertSee($user->name);
});

test('dont sees normal users', function () {
    $this->actingAs(User::factory([
        'role' => 'admin',
    ])->create());

    $user = User::factory([
        'role' => User::USER_ROLE,
    ])->create();

    $this->get(route('system-users.index'))
        ->assertSuccessful()
        ->assertDontSee($user->name);
});

test('admin can update a user', function () {
    $this->actingAs($user = User::factory([
        'role' => 'admin',
    ])->withCurrentCompany()->create());

    $userToUpdate = User::factory([
        'role' => User::PARTNER_ROLE,
    ])->create();

    Livewire::test(App\Livewire\SystemUser\Edit::class, ['user' => $userToUpdate])
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

test('user without permission to edit cannot delete a user', function () {
    $this->actingAs(User::factory([
        'role' => User::USER_ROLE,
    ])->withCurrentCompany()->create()->givePermissionTo('users.view'));

    $user = User::factory()->create([
        'current_company_id' => auth()->user()->currentCompany->id
    ]);

    Livewire::test(\App\Livewire\SystemUser\Index::class)
        ->call('delete', $user);

    expect($user->fresh()->deleted_at)->toBeNull();
});
