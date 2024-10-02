<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public Form $form;
    public bool $canChangeStatus = true;

    public function create()
    {
        $this->form->validate();

        if(!$this->form->password) {
            $this->form->addError('password', 'The password field is required.');
            return;
        }

        $user = User::withTrashed()->where('email', $this->form->email)->first();
        if(!$user) {
            $user = User::create(array_merge($this->form->toArray(), [
                'current_company_id' => auth()->user()->currentCompany->id,
                'password' => bcrypt($this->form->password),
            ]));
        } else {
            if(!$user->trashed()) {
                $user->restore();
            }
            $user->update(array_merge($this->form->toArray(), [
                'current_company_id' => auth()->user()->currentCompany->id,
                'role' => 'user',
                'password' => bcrypt($this->form->password),
            ]));
        }

        if(auth()->user()->currentCompany) {
            if(!$user->companies->contains(auth()->user()->currentCompany->id)) {
                auth()->user()->currentCompany->users()->attach($user);
            }
        }

        $allowed_permissions = [];
        foreach($this->form->permissions as $module_key => $module) {
            foreach($module as $permission => $value) {
                if($value) {
                    $allowed_permissions[] = $module_key .'.'. $permission;
                }
            }
        }
        $user->syncPermissions($allowed_permissions);

        return redirect()->route('users.index')->with('flash.banner', 'User created.');
    }

    public function render()
    {
        $this->authorize('create', User::class);
        return view('livewire.user.create');
    }
}
