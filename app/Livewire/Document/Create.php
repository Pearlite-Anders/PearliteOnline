<?php

namespace App\Livewire\Document;

use App\Data\DocumentData;
use App\Data\PermissionData;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\WithTrixUploads;
use Illuminate\Support\Collection;

class Create extends Component
{
    use WithFileUploads, WithTrixUploads;

    public Form $form;
    public Collection $users;

    public function mount()
    {
        abort_unless(auth()->user()->can('viewAny', Document::class), 403);
        $this->form->data = DocumentData::from([
            'title' => '',
            'default_view' => true,
            'default_edit' => false
        ]);

        // TODO: Maybe som pagination here
        $this->users = auth()->user()->currentCompany->users()->where('role', User::USER_ROLE)->get();
        $this->form->permissions = $this->users->mapWithKeys(function($user, $key) {
            return [$user->id => [
                'name' => $user->name,
                'view' => true,
                'edit' => false,
            ]];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.document.create');
    }

    public function create()
    {
        $document = $this->form->create();

        return redirect()->route('documents.show', ['document' => $document->id])
            ->with('flash.banner', __('Document created.'));
    }

    public function togglePermission($user_index, $permission)
    {
        $this->form->togglePermission($user_index, $permission);
    }

    public function toggleAllViewPermission()
    {
        $this->form->toggleAllViewPermission();
    }

    public function toggleAllEditPermission()
    {
        $this->form->toggleAllEditPermission();
    }
}
