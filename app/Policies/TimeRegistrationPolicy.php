<?php

namespace App\Policies;

use App\Models\TimeRegistration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TimeRegistrationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('time_registration.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TimeRegistration $timeRegistration): bool
    {
        return $user->hasPermissionTo('time_registration.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('time_registration.view');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TimeRegistration $timeRegistration): bool
    {
        return $user->hasPermissionTo('time_registration.view');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TimeRegistration $timeRegistration): bool
    {
        return $user->hasPermissionTo('time_registration.view');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TimeRegistration $timeRegistration): bool
    {
        return $user->hasPermissionTo('time_registration.view');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TimeRegistration $timeRegistration): bool
    {
        return $user->hasPermissionTo('time_registration.view');
    }
}
