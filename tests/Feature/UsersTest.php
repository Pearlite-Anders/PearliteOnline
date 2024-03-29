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
                ]
            )
            ->assertSet('form.name', 'Test User')
            ->assertSet('form.email', 'test@test.com')
            ->assertSet('form.password', '123456')
            ->call('update');

    $userToUpdate->refresh();
    expect($userToUpdate->name)->toBe('Test User');
    expect($userToUpdate->email)->toBe('test@test.com');
    expect($userToUpdate->role)->toBe(User::USER_ROLE);
    expect(Hash::check('123456', $userToUpdate->password))->toBeTrue();
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

test('user with permission to edit can delete a user', function () {
    $this->actingAs(User::factory([
        'role' => User::USER_ROLE,
    ])->withCurrentCompany()->create()->givePermissionTo('users.edit'));

    $user = User::factory()->create([
        'current_company_id' => auth()->user()->currentCompany->id
    ]);

    Livewire::test(App\Livewire\User\Index::class)
        ->call('delete', $user);

    expect($user->fresh()->deleted_at)->not()->toBeNull();
});

test('user without permission to edit cannot delete a user', function () {
    $this->actingAs(User::factory([
        'role' => User::USER_ROLE,
    ])->withCurrentCompany()->create()->givePermissionTo('users.view'));

    $user = User::factory()->create([
        'current_company_id' => auth()->user()->currentCompany->id
    ]);

    Livewire::test(App\Livewire\User\Index::class)
        ->call('delete', $user);

    expect($user->fresh()->deleted_at)->toBeNull();
});
