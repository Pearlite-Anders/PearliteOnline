<?php

namespace App\Policies;

use App\Models\User;

class BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->isPartner()) {
            return true;
        }

        return $user->can($this->type .'.view') || $user->can($this->type .'.edit');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $model): bool
    {
        if (!$user->companies()->pluck('companies.id')->contains($model->company_id)) {
            return false;
        }

        if($user->isPartner()) {
            return true;
        }

        return $user->can($this->type .'.view') || $user->can($this->type .'.edit');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->isPartner()) {
            return true;
        }

        return $user->can($this->type .'.edit');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $model): bool
    {

        if (!$user->companies()->pluck('companies.id')->contains($model->company_id)) {
            return false;
        }

        if($user->isPartner()) {
            return true;
        }

        return $user->can($this->type .'.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $model): bool
    {
        if (!$user->companies()->pluck('companies.id')->contains($model->company_id)) {
            return false;
        }

        if($user->isPartner()) {
            return true;
        }

        return $user->can($this->type .'.edit');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        if (!$user->companies()->pluck('companies.id')->contains($model->company_id)) {
            return false;
        }

        if($user->isPartner()) {
            return true;
        }

        return $user->can($this->type .'.edit');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        if (!$user->companies()->pluck('companies.id')->contains($model->company_id)) {
            return false;
        }

        if($user->isPartner()) {
            return true;
        }

        return $user->can($this->type .'.edit');
    }
}
