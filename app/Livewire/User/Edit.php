<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Company;
use Livewire\Component;

class Edit extends Component
{
    public Form $form;
    public User $user;

    public function update()
    {
        $this->authorize('update', $this->user);
        $this->form->validate();

        $allowed_permissions = [];
        foreach($this->form->permissions as $module_key => $module) {
            foreach($module as $permission => $value) {
                if($value) {
                    $allowed_permissions[] = $module_key .'.'. $permission;
                }
            }
        }
        $this->user->syncPermissions($allowed_permissions);

        $this->user->name = $this->form->name;
        $this->user->email = $this->form->email;
        if(auth()->user()->isAdmin()) {
            $this->user->role = $this->form->role;
        }

        if($this->form->password) {
            $this->user->password = bcrypt($this->form->password);
        }

        $this->user->save();


        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('User updated successfully.')
        );
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form->name = $user->name;
        $this->form->email = $user->email;
        $this->form->role = $user->role;


        // Permissions
        $permissions = [];
        foreach(auth()->user()->currentCompany->modules() as $module_key => $module) {
            foreach($module->permissions as $permission => $permission_name) {
                $permissions[$module_key][$permission] = $user->can($module_key .'.'. $permission);
            }
        }

        $this->form->permissions = $permissions;
    }

    public function render()
    {
        $this->authorize('update', $this->user);

        return view('livewire.user.edit');
    }
}
