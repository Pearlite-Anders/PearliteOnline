<div>
    <h2 class="truncate text-lg text-gray-900 mb-4">{{ $header }} <span wire:loading.remove>({{ $totalTasks }})</span></h2>
    <div wire:loading>
        <x-loading>{{ _('Loading tasks...') }}</x-loading>
    </div>
    <div wire:loading.remove>
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8 max-w-7xl">
            @if ($tasks->count() > 0 && $totalTasks == 0)
                <p class="text-sm text-gray-500">
                    {{ _('You haven’t any open tasks.') }} <br />
                    {{ _('Good work!, keep it up.') }} {{ _('Or maybe you should check your filters') }}
                </p>
            @else
                @forelse($tasks as $module => $moduleTasks)
                    @foreach($moduleTasks as $task)
                        <div class="overflow-hidden rounded-lg bg-white shadow" wire:key="{{$module}}-{{$task->id}}">
                            @switch($module)
                                @case(App\Livewire\Dashboard\Module::Supplier->value)
                                    @include('livewire.dashboard._supplier_task')
                                    @break
                                @case(App\Livewire\Dashboard\Module::WeldingCertificate->value)
                                    @include('livewire.dashboard._welding_certificate_task')
                                    @break
                                @case(App\Livewire\Dashboard\Module::MachineMaintenance->value)
                                    @include('livewire.dashboard._machine_maintenance_task')
                                    @break
                            @endswitch
                        </div>
                    @endforeach
                @empty
                    <p class="text-sm text-gray-500">
                        {{ _('You haven’t selected any modules.') }}
                    </p>
                @endforelse
            @endif
        </div>
    </div>
</div>
