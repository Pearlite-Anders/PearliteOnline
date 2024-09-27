<x-mail::message>
# {{ __('Hello') }} {{ $user->name }},

@if($supplier_assessments_data)
    {{
        sprintf(
            __('You have %s supplier(s) you need to assess.'),
            count($supplier_assessments_data['supplierIds'])
        )
    }}
    <x-mail::button
        :url="route('supplier.index', ['filters[ids]' => implode(', ', $supplier_assessments_data['supplierIds'])])"
    >
        {{__('View suppliers')}}
    </x-mail::button>
@endif

@if($machine_maintenance_data)
    {{
        sprintf(
            __('You have %s machines(s) you need to maintain.'),
            count($machine_maintenance_data['machineMaintenanceIds'])
        )
    }}
    <x-mail::button
        :url="route('machine-maintenance.index', ['filters[ids]' => implode(', ', $machine_maintenance_data['machineMaintenanceIds'])])"
    >
        {{__('View maintenances')}}
    </x-mail::button>
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
