<div>
    <x-index-header>
        <x-slot name="heading">
            {{ __('Dashboard') }}
        </x-slot>
    </x-index-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6">
        <div class="flex justify-between">
            <div class="flex items-center justify-between py-3">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-900">{{ _('Due date') }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        @foreach(\App\Livewire\Dashboard\Interval::cases() as $interval)
                            <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if($filters->interval->value == $interval->value) border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                                <input
                                    type="radio"
                                    wire:model.live="filters.interval"
                                    value="{{ $interval->value }}"
                                    class="hidden"
                                />
                                <span>{{ $interval->label() }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between py-3">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-900">{{ _('Modules') }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        @foreach(\App\Livewire\Dashboard\Module::cases() as $module)
                            <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if(in_array($module->value, $filters->modules)) border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                                <input
                                    type="checkbox"
                                    wire:model.live="filters.modules"
                                    value="{{ $module->value }}"
                                    class="hidden"
                                />
                                <span>{{ $module->label() }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8">
            <livewire:dashboard.my-tasks :$filters :header="_('My tasks')" lazy />
        </div>

        <div class="mt-8">
           <livewire:dashboard.company-tasks :$filters :header="_('Company tasks')" lazy />
        </div>
    </div>
<div>
