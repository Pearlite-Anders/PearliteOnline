<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\On;
use App\Enums\Module;
use App\Models\Document;
use App\Models\MachineMaintenance;
use App\Models\Supplier;
use App\Livewire\DataTable\WithClickableRow;
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

    #[On('maintenance-created')]
    public function reportCreated()
    {
        // Dont do anything, simply here to trigger render
    }

    #[On('assessment-created')]
    public function assessmentCreated()
    {
        // Dont do anything, simply here to trigger render
    }

    protected function tasks()
    {
        $tasks = [];
        if (in_array(Module::Supplier->value, $this->filters->modules)) {
            $tasks['supplier'] = $this->supplier();
        }

        if (in_array(Module::MachineMaintenance->value, $this->filters->modules)) {
            $tasks['machine_maintenance'] = $this->machine_maintenance();
        }

        if (in_array(Module::Document->value, $this->filters->modules)) {
            $tasks['document'] = $this->document();
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

    protected function machine_maintenance()
    {
        $user = \Auth::user();
        $query = MachineMaintenance::where("responsible_user_id", "=", $user->id);
        $query = $this->filters->apply($query, Module::MachineMaintenance);

        return $query->get();
    }

    protected function document()
    {
        $user = \Auth::user();
        $query = Document::where("owner_id", "=", $user->id);
        $query = $this->filters->apply($query, Module::Document);

        return $query->get();
    }
}
