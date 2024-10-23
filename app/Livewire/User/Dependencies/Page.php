<?php

namespace App\Livewire\User\Dependencies;

use App\Models\User;
use Livewire\Component;

class Page extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.dependencies.page');
    }
}
