<?php

namespace App\View\Components;

use App\Enums\Module;
use App\Models\Supplier;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarEntryNotifications extends Component
{
    public Module $module;

    /**
     * Create a new component instance.
     */
    public function __construct(string $module)
    {
        $this->module = Module::from($module);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tasks = $this->getNotifications();
        return view('components.sidebar-entry-notifications')->with('tasks', $tasks);
    }

    private function getNotifications()
    {
        return match ($this->module) {
            Module::Supplier => $this->suppliers(),
            Module::MachineMaintenance => $this->machineMaintenance(),
            Module::WeldingCertificate => $this->weldingCertificates(),
            default => collect()
        };
    }

    private function suppliers()
    {
        $user = \Auth::user();
        if ($user->can('company_task.view')) {
            $query = $user->currentCompany->suppliers();
        } else {
            $query = Supplier::where("responsible_user_id", "=", $user->id);
        }

        $query = $query->whereRaw(
            "DATE_ADD(JSON_UNQUOTE(JSON_EXTRACT(data, '$.latest_assessment_date')), INTERVAL JSON_UNQUOTE(JSON_EXTRACT(data, '$.assessment_frequency')) MONTH) <= ?",
            [now()->format('Y-m-d')]
        );

        $query = $query->where('data->needs_assessment', '!=', "no");
        return $query->get();
    }

    private function machineMaintenance()
    {
        $user = \Auth::user();

        if (!$user->can('company_task.view')) {
            return collect();
        }

        $query = $user->currentCompany->machineMaintenances();

        $query = $query->whereRaw("DATE(JSON_UNQUOTE(JSON_EXTRACT(data, '$.next_maintenance_date'))) <= ?", [now()->format('Y-m-d')]);

        $query = $query->where('data->status', '!=', "no");
        return $query->get();
    }

    private function weldingCertificates()
    {
        $user = \Auth::user();

        if (!$user->can('company_task.view')) {
            return collect();
        }
        $query = $user->currentCompany->weldingCertificates();

        $query->whereRaw("DATE(JSON_UNQUOTE(JSON_EXTRACT(data, '$.date_next_signature'))) <= ?", [now()->format('Y-m-d')]);

        $query = $query->where('data->status', '!=', "no");
        return $query->get();
    }

}
