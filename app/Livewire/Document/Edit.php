<?php

namespace App\Livewire\Document;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Livewire\WithTrixUploads;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Collection;

class Edit extends Component
{
    use WithFileUploads, WithTrixUploads;

    public Form $form;
    public Document $document;
    public Collection $users;

    public function render()
    {
        return view('livewire.document.edit');
    }

    public function mount(Document $document)
    {
        abort_unless(auth()->user()->can('update', $document), 403);
        $this->document = $document;
        $this->form->setFields($document);

        $this->users = auth()->user()->currentCompany->users()->where('role', User::USER_ROLE)->get();

        $permissions =  $this->users->mapWithKeys(function($user, $key) {
            return [$user->id => [
                'name' => $user->name,
                'view' => false,
                'edit' => false,
            ]];
        })->toArray();
        foreach($document->users as $user)  {
            $permissions[$user->id]['view'] = $user->pivot->view;
            $permissions[$user->id]['edit'] = $user->pivot->edit;
        }

        $this->form->permissions = $permissions;
    }

    public function update()
    {
        $this->form->update($this->document);

        return redirect()
                ->route('documents.show', ['document' => $this->document->id])
                ->with('flash.banner', __('Document updated.'));
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
