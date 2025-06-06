<?php

namespace App\Livewire\Dashboard;

use App\Livewire\DataTable\WithClickableRow;
use App\Models\Supplier;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class MyTasks extends Component
{
    use WithClickableRow;

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
        if (in_array(Module::Supplier->value, $this->filters->modules)) {
            $tasks['supplier'] = $this->supplier();
        }

        return collect($tasks);
    }

    protected function supplier()
    {
        $user = \Auth::user();
        $query = Supplier::where("responsible_user_id", "=", $user->id);
        $query = $this->filters->apply($query, Module::Supplier);

        return $query->get();
    }
}
