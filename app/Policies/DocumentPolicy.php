<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentPolicy extends BasePolicy
{
    public $type = 'document';

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $document): bool
    {
        if ($document->owner_id == $user->id) {
            return true;
        }

        return parent::view($user, $document);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $document): bool
    {
        if ($document->owner_id == $user->id) {
            return true;
        }

        return parent::update($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $document): bool
    {
        if ($document->owner_id == $user->id) {
            return true;
        }

        return parent::delete($user);
    }

}
