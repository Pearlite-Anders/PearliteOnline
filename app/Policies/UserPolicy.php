<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy extends BasePolicy
{
    public $type = 'users';

    public function impersonate(User $user, User $model): bool
    {
        return $user->isAdmin() && !$model->isAdmin();
    }
}
