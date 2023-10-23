<?php

namespace App\Policies;

use App\Models\User;

class SettingsPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('settings.view');
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo('settings.edit');
    }
}
