<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WeldingCertificate;
use Illuminate\Auth\Access\Response;

class WeldingCertificatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('welding-certificates.view') || $user->can('welding-certificates.edit');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WeldingCertificate $weldingCertificate): bool
    {
        return $user->can('welding-certificates.view') || $user->can('welding-certificates.edit');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('welding-certificates.edit');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WeldingCertificate $weldingCertificate): bool
    {
        return $user->can('welding-certificates.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WeldingCertificate $weldingCertificate): bool
    {
        return $user->can('welding-certificates.edit');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WeldingCertificate $weldingCertificate): bool
    {
        return $user->can('welding-certificates.edit');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WeldingCertificate $weldingCertificate): bool
    {
        return $user->can('welding-certificates.edit');
    }
}
