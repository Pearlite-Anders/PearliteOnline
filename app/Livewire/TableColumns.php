<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class TableColumns extends Component
{
    #[Reactive]
    public $columns;

    public $model;

    public $showModal = false;

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function render()
    {
        return view('livewire.table-columns');
    }
}
