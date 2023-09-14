<?php

namespace App\Livewire;

use Livewire\Component;

class TopNavigation extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.top-navigation');
    }
}
