<?php

use App\Models\User;

test('settings is visible in menu if user has access', function () {
    $this->actingAs(User::factory()->withCurrentCompany()->create()->givePermissionTo('settings.view'));
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
    $response->assertSee(route('settings'));
});

test('settings is not visible in menu if user does not have access', function () {
    $this->actingAs(User::factory()->withCurrentCompany()->create());
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
    $response->assertDontSee(route('settings'));
});
