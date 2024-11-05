<?php

namespace App\Livewire\TopNavigation;

use Livewire\Component;

class Backoffice extends Component
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
        return view('livewire.top-navigation.backoffice');
    }
}
