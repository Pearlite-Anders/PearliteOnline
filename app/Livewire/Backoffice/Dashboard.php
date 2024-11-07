<?php

namespace App\Livewire\Backoffice;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.backoffice.dashboard');
    }
}
