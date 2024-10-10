<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Page extends Component
{
    public Filters $filters;

    public function mount()
    {
        $this->filters->init();
    }

    public function render()
    {
        return view('livewire.dashboard.page');
    }

    public function companyTasks()
    {
        return collection([]);
    }
}
