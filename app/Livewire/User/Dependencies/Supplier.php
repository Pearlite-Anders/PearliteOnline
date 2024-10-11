<?php

namespace App\Livewire\User\Dependencies;

use App\Livewire\DataTable\WithColumns;
use App\Models\Supplier as Model;
use App\Models\User;
use Livewire\Component;

class Supplier extends Component
{
    use WithColumns;

    public User $user;
    public $model = Model::class;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.dependencies.supplier');
    }
}
