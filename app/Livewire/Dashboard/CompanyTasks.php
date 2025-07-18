<?php

namespace App\Livewire\Dashboard;

use App\Livewire\DataTable\WithClickableRow;
use App\Enums\Module;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CompanyTasks extends Component
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

    protected function tasks(): Collection
    {
        $tasks = [];
        foreach($this->filters->modules as $module) {
            $tasks[$module] = $this->$module();
        }

        return collect($tasks);
    }

    protected function supplier(): Collection
    {
        $user = \Auth::user();
        $query = $user->currentCompany->suppliers()->where("responsible_user_id", '!=', $user->id);
        $query = $this->filters->apply($query, Module::Supplier);

        return $query->get();
    }

    protected function welding_certificate(): Collection
    {
        $user = \Auth::user();
        $query = $user->currentCompany->weldingCertificates();
        $query = $this->filters->apply($query, Module::WeldingCertificate);

        return $query->get();
    }

    protected function machine_maintenance(): Collection
    {
        $user = \Auth::user();
        $query = $user->currentCompany->machineMaintenances();
        $query = $this->filters->apply($query, Module::MachineMaintenance);

        return $query->get();
    }

    protected function document(): Collection
    {
        $user = \Auth::user();
        $query = $user->currentCompany->documents();
        $query = $this->filters->apply($query, Module::Document);

        return $query->get();
    }
}
