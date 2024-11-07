<?php

namespace App\Livewire\Backoffice\SystemUser;


use App\Models\User;
use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    public $confirming;

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function cancelConfirmDelete()
    {
        $this->confirming = null;
    }

    public function delete(User $user)
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }
        $this->authorize('delete', $user);

        $user->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('User deleted successfully.')
        );
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('livewire.backoffice.system-user.index')->with([
            'users' => User::where('role', '!=', User::USER_ROLE)->paginate(100)
        ]);
    }
}
