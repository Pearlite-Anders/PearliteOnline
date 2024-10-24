<?php

namespace App\Livewire\User\Dependencies;

use App\Livewire\DataTable\WithColumns;
use App\Models\MachineMaintenance as Model;
use App\Models\User;
use Livewire\Component;

class MachineMaintenance extends Component
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
        return view('livewire.user.dependencies.machine-maintenance');
    }
}
