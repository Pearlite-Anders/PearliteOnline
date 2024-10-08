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
    public $hasDependencies;

    public function confirmDelete(User $user)
    {
        $dependecies = $user->dependenciesCount();
        $this->hasDependencies = $user->hasDependencies();
        $this->confirming = $user->id;
    }

    public function cancelConfirmDelete()
    {
        $this->confirming = null;
        $this->hasDependencies = null;
    }

    public function delete(User $user)
    {
        if ($user->hasDependencies()) {
            $this->dispatch(
                'banner-message',
                style: 'error',
                message: __('User still has dependecies')
            );
            return;
        }

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
