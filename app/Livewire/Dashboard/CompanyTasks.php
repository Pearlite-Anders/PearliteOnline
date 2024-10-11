<?php

namespace App\Livewire\Dashboard;

use App\Models\Supplier;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CompanyTasks extends Component
{
    #[Reactive]
    public Filters $filters;

    public string $header;

    public function render()
    {
        $tasks = $this->tasks();
        $totalTasks = $tasks->sum(fn($task) => $task->count());
        return view('livewire.dashboard.tasks', compact('tasks', 'totalTasks'));
    }

    public function placeholder($params = [])
    {
        $header = $params['header'];
        return view('livewire.dashboard.placeholder', compact('header'));
    }

    protected function tasks()
    {
        $tasks = [];
        foreach($this->filters->modules as $module) {
            $tasks[$module] = $this->$module();
        }

        return collect($tasks);
    }

    protected function supplier()
    {
        $user = \Auth::user();
        $query = $user->currentCompany->suppliers()->whereNull("responsible_user_id");
        $query = $this->filters->apply($query, Module::Supplier);

        return $query->get();
    }

    protected function welding_certificate()
    {
        $user = \Auth::user();
        $query = $user->currentCompany->weldingCertificates();
        $query = $this->filters->apply($query, Module::WeldingCertificate);

        return $query->get();
    }
}
