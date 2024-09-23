<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use App\Data\DocumentData;
use Illuminate\Auth\Access\Response;

class DocumentPolicy extends BasePolicy
{
    public $type = 'document';

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $document): bool
    {
        if ($user->isPartner()) {
            return true;
        }

        if ($document->owner_id == $user->id) {
            return true;
        }

        if (!($user->can($this->type .'.view') || $user->can($this->type .'.edit'))) {
            return false;
        };

        $data = DocumentData::from($document->data);

        if ($data->default_view || $data->default_edit) {
            return true;
        }

        $user = $document->users()->find($user->id);

        if (!$user) {
            return false;
        }

        return $user->pivot->view || $user->pivot->edit;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $document): bool
    {
        if ($user->isPartner()) {
            return true;
        }

        if ($document->owner_id == $user->id) {
            return true;
        }

        if (!$user->can($this->type .'.edit')) {
            return false;
        };

        $data = DocumentData::from($document->data);

        if ($data->default_edit) {
            return true;
        }

        $user = $document->users()->find($user->id);

        if (!$user) {
            return false;
        }

        return $user->pivot->edit;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $document): bool
    {
        return $this->update($user, $document);
    }

}
