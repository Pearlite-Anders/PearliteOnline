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

    public function render()
    {
        $this->authorize('viewAny', User::class);

        if(auth()->user()->isAdmin()) {
            $users = User::paginate(100);
        } else {
            if(auth()->user()->currentCompany) {
                $users = auth()->user()->currentCompany->users()->paginate(100);
            } else {
                $users = User::where('id', 0)->paginate(100);
            }
        }

        return view('livewire.user.index')->with([
            'users' => $users,
        ]);
    }
}
