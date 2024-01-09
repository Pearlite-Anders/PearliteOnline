<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

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
        $this->authorize('delete', $user);

        if(auth()->user()->currentCompany) {
            auth()->user()->currentCompany->users()->detach($user);
        }

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('User deleted successfully.')
        );
    }

    public function render()
    {
        $this->authorize('viewAny', User::class);
        if(auth()->user()->currentCompany) {
            $users = auth()->user()->currentCompany->users()->where('role', User::USER_ROLE)->paginate(100);
        } else {
            $users = User::where('id', 0)->paginate(100);
        }

        return view('livewire.user.index')->with([
            'users' => $users,
        ]);
    }
}
