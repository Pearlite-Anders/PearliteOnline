<?php

namespace App\Livewire\Backoffice\SystemUser;

use App\Models\User;
use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    public Form $form;
    public User $user;

    public function update()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->authorize('update', $this->user);
        $this->form->validate();

        $this->user->name = $this->form->name;
        $this->user->email = $this->form->email;
        $this->user->role = $this->form->role;

        if($this->form->password) {
            $this->user->password = bcrypt($this->form->password);
        }

        $this->user->save();

        $companies = [];
        foreach($this->form->companies as $company_id => $value) {
            if($value) {
                $companies[] = $company_id;
            }
        }
        if($this->user->role == User::PARTNER_ROLE) {
            $this->user->companies()->sync($companies);
        }

        $permssions = [];
        if($this->form->can_see_time_registration) {
            $permssions[] = 'time_registration.view';
        }

        $this->user->syncPermissions($permssions);

        return redirect()
                ->route('backoffice.system-users.index')
                ->with('flash.banner', __('User updated.'));
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form->name = $user->name;
        $this->form->email = $user->email;
        $this->form->role = $user->role;
        $this->form->companies = $user->companies->pluck('id')->mapWithKeys(function ($company_id) {
            return [$company_id => true];
        })->toArray();

        $this->form->can_see_time_registration = $user->hasPermissionTo('time_registration.view');
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }
        $this->authorize('update', $this->user);

        return view('livewire.backoffice.system-user.edit')->with([
            'companies' => Company::all(),
        ]);
    }
}
