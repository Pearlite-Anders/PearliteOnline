<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Collection;
use Livewire\Component;

class Edit extends Component
{
    public Form $form;
    public User $user;
    public bool $canChangeStatus = true;
    public Collection $dependecies;

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
        $this->user->active = $this->form->active;

        if($this->form->password) {
            $this->user->password = bcrypt($this->form->password);
        }

        $this->user->save();


        return redirect()
                ->route('users.index')
                ->with('flash.banner', __('User updated.'));
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form->name = $user->name;
        $this->form->email = $user->email;
        $this->form->role = $user->role;
        $this->form->active = $user->active;


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
