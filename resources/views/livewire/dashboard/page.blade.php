<div>
    <x-index-header>
        <x-slot name="heading">
            {{ __('Dashboard') }}
        </x-slot>
    </x-index-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6">
        <div class="flex justify-between items-center max-w-7xl">
            <div class="flex items-center justify-between py-3">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-900">{{ __('Due date') }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        @foreach(\App\Livewire\Dashboard\Interval::cases() as $interval)
                            <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if($filters->interval == $interval->value) border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
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
            <div class="flex items-center justify-between py-3 gap-x-6">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-900">{{ __('Modules') }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if($filters->isAllModulesSelected()) border-cyan-400 bg-slate-50 @else bg-white border-gray-200 @endif">
                            <button type="button" wire:click="selectAllModules" class="focus:outline-none">
                                <span>{{ __('All') }}</span>
                            </button>
                        </label>

                        @foreach(\App\Enums\Module::cases() as $module)
                            <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if(in_array($module->value, $filters->modules)) border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                                <button type="button" wire:click="selectSingleModule('{{ $module->value }}')" class="focus:outline-none">
                                    <span>{{ $module->label() }}</span>
                                </button>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">

                        <label class="flex px-2 py-1 text-sm leading-none border rounded-l-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if($filters->view == 'card') border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                            <input
                                type="radio"
                                wire:model.live="filters.view"
                                value="card"
                                class="hidden"
                            />
                            <span><x-icon.square-2-stack class="h-4"/></span>
                        </label>
                        <label class="flex px-2 py-1 text-sm leading-none border rounded-r-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if($filters->view == 'table') border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                            <input
                                type="radio"
                                wire:model.live="filters.view"
                                value="table"
                                class="hidden"
                            />
                            <span><x-icon.bars-3 class="h-4"/></span>
                        </label>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8">
            <livewire:dashboard.my-tasks :$filters :header="__('My tasks')" lazy />
        </div>

        @can('company_task.view')
            <div class="mt-8">
                <livewire:dashboard.company-tasks :$filters :header="__('Company tasks')" lazy />
            </div>
        @endcan
    </div>
<div>
