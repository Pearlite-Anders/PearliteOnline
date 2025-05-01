<?php

namespace App\Livewire\Dashboard;

use App\Enums\Module;
use Livewire\Component;

class Page extends Component
{
    public Filters $filters;

    public function mount()
    {
        $this->filters->init();
    }

    public function selectAllModules()
    {
        $this->filters->modules = array_map(fn ($module) => $module->value, Module::cases());
    }

    public function selectSingleModule($moduleValue)
    {
        $this->filters->modules = [$moduleValue];
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
