<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Url;
use Livewire\Form;

class Filters extends Form
{
    #[Url(as: 'interval')]
    public string $interval = Interval::Today->value;

    #[Url(as: 'modules')]
    public array $modules = [];

    public function init()
    {
        if (empty($this->modules)) {
            $this->modules = array_map(fn($module) => $module->value, Module::cases());
        }
    }

    public function apply($query, Module $module)
    {
        $query = $this->applyModule($query, $module);
        return $query;
    }

    protected function applyModule($query, Module $module)
    {
        return match ($module) {
            Module::Supplier => $this->applySupplierModule($query),
            Module::WeldingCertificate => $this->applyWeldingCertificateModule($query),
            Module::MachineMaintenance => $this->applyMachineMaintenanceModule($query),
        };
    }

    protected function applySupplierModule($query)
    {
        $interval = Interval::from($this->interval);
        $query = $query->whereRaw(
            "DATE_ADD(JSON_UNQUOTE(JSON_EXTRACT(data, '$.latest_assessment_date')), INTERVAL JSON_UNQUOTE(JSON_EXTRACT(data, '$.assessment_frequency')) MONTH) <= ?",
            [$interval->date()]
        );

        return $query->where('data->needs_assessment', '!=', "no");
    }

    protected function applyWeldingCertificateModule($query)
    {
        $interval = Interval::from($this->interval);
        return $query->whereRaw("DATE(JSON_UNQUOTE(JSON_EXTRACT(data, '$.date_next_signature'))) <= ?", [$interval->date()]);
    }

    protected function applyMachineMaintenanceModule($query)
    {
        $interval = Interval::from($this->interval);
        return $query->whereRaw("DATE(JSON_UNQUOTE(JSON_EXTRACT(data, '$.next_maintenance_date'))) <= ?", [$interval->date()]);
    }


}
