<?php

namespace App\Livewire\Backoffice\SystemUser;

use App\Models\User;
use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Create extends Component
{
    public Form $form;

    public function create()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }
        $this->form->validate();

        if(!$this->form->password) {
            $this->form->addError('password', 'The password field is required.');
            return;
        }

        $user = User::withTrashed()->where('email', $this->form->email)->first();
        if(!$user) {
            $user = User::create(array_merge($this->form->toArray(), [
                'password' => bcrypt($this->form->password),
            ]));
        } else {
            $user->restore();
            $user->update(array_merge($this->form->toArray(), [
                'password' => bcrypt($this->form->password),
            ]));
        }

        if (!$user->isAdmin()) {
            $companies = [];
            foreach($this->form->companies as $company_id => $value) {
                if($value) {
                    $companies[] = $company_id;
                }
            }
            $user->companies()->sync($companies);
        }

        $permssions = [];
        if($this->form->can_see_time_registration) {
            $permssions[] = 'time_registration.view';
        }

        $user->syncPermissions($permssions);

        return redirect()->route('backoffice.system-users.index')->with('flash.banner', 'User created.');
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->authorize('create', User::class);
        return view('livewire.backoffice.system-user.create')->with([
            'companies' => Company::all(),
        ]);
    }
}
