<?php

namespace App\Livewire\Dashboard;

use App\Models\Supplier;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CompanyTasks extends Component
{
    #[Reactive]
    public Filters $filters;

    public function render()
    {
        $tasks = $this->tasks();
        return view('livewire.dashboard.tasks', compact('tasks'));
    }

    protected function tasks()
    {
        $tasks = [];
        foreach($this->filters->modules as $module) {
            if ($module != Module::Supplier->value) {
                continue;
            }

            $tasks['supplier'] = $this->suppliers();
        }

        return collect($tasks);
    }

    protected function suppliers()
    {
        $user = \Auth::user();
        $query = $user->currentCompany->suppliers()->whereNull("responsible_user_id");
        $query = $this->filters->apply($query, Module::Supplier);

        return $query->get();
    }
}
