<div x-data="{ open: false }" class="col-span-6">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3"
        @php($count = 0)
        @php($visible = 0)
        @foreach($filterColumns as $filter)
            @php($count++)
            @if(!$filter->visible) @continue @endif
            @if($visible >= 3) @break @endif
            @php($visible++)

            @php($filter_column = $model::getColumn($filter->key))
            @if(optional($filter_column)->filter == 'relationship')
                <div class="relative">
                    <select
                        wire:model.live="filters.{{ $filter->key }}"
                        class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                    >
                        <option value="">{{ $filter_column->label }}</option>
                        @foreach($filter_column->class::get_choices() as $key => $option)
                            <option value="{{ $key }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if(optional($filter_column)->filter == 'select')
                <div>
                    <select
                        wire:model.live="filters.{{ $filter->key }}"
                        class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                    >
                        <option value="">{{ $filter_column->label }}</option>
                        @foreach(App\Models\Setting::get($filter_column->options) as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if(optional($filter_column)->filter == 'search')
                <div class="">
                    <input
                        type="search"
                        wire:model.live.debounce.500ms="filters.{{ $filter->key }}"
                        class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                        placeholder="{{ $filter_column->label }}"
                    />
                </div>
            @endif
        @endforeach
    </div>
    @if(count($filterColumns) > 3)
        <div class="absolute top-0 right-0">
            <x-button.secondary @click="open = !open">
                <x-icon.plus class="w-6 h-6" x-show="!open" />
                <x-icon.minus class="w-6 h-6" x-show="open" />
            </x-button.secondary>
        </div>
    @endif
    <div x-show="open" @click.outside="open = false" class="absolute left-0 right-0 p-4 mt-3 bg-white border rounded-sm shadow-md">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            @foreach($filterColumns->slice(($count - 1), -1) as $filter)
                @php($filter_column = $model::getColumn($filter->key))
                @if(optional($filter_column)->filter == 'relationship')
                    <div class="relative">
                        <x-label for="$filter->key" :value="__($filter_column->label)" class="!mb-0 text-xs leading-tight" />
                        <select
                            wire:model.live="filters.{{ $filter->key }}"
                            class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                        >
                            <option value="">{{ $filter_column->label }}</option>
                            @foreach($filter_column->class::get_choices() as $key => $option)
                                <option value="{{ $key }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if(optional($filter_column)->filter == 'select')
                    <div class="relative">
                        <x-label for="$filter->key" :value="__($filter_column->label)" class="!mb-0 text-xs leading-tight" />
                        <select
                            wire:model.live="filters.{{ $filter->key }}"
                            class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                        >
                            <option value="">{{ $filter_column->label }}</option>
                            @foreach(App\Models\Setting::get($filter_column->options) as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if(optional($filter_column)->filter == 'search')
                    <div class="relative">
                        <x-label for="$filter->key" :value="__($filter_column->label)" class="!mb-0 text-xs leading-tight" />
                        <x-input
                            type="search"
                            id="$filter->key"
                            wire:model.live.debounce.500ms="filters.{{ $filter->key }}"
                            class=""
                            placeholder="{{ $filter_column->label }}"
                        />
                    </div>
                @endif
                @if(optional($filter_column)->filter == 'date')
                    <div class="relative grid grid-cols-2 col-span-2 gap-4">
                        <div>
                            <x-label for="$filter->key" :value="__('From: ') . $filter_column->label" class="!mb-0 text-xs leading-tight" />
                            <x-input.date
                                wire:model="filters.{{ $filter->key }}.min"
                                :value="optional(optional($filters)[$filter->key])['min']"
                                placeholder="{{__('From: ') . $filter_column->label }}"
                            />
                        </div>
                        <div>
                            <x-label for="$filter->key" :value="__('To: ') . $filter_column->label" class="!mb-0 text-xs leading-tight" />
                            <x-input.date
                                wire:model="filters.{{ $filter->key }}.max"
                                :value="optional(optional($filters)[$filter->key])['max']"
                                placeholder="{{__('To: ') . $filter_column->label }}"
                            />
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="flex justify-end mt-4 space-x-4">
            <x-button.secondary wire:click="toggleFilterSettingsModal" class="flex items-center justify-center">
                <x-icon.settings class="w-6 h-6 mr-2 -ml-2 text-gray-600" /> {{__('Settings')}}
            </x-button.secondary>
            <x-button.secondary wire:click="clearFilters" class="flex items-center justify-center">
                <x-icon.trash class="w-6 h-6 mr-2 -ml-2 text-gray-600" /> {{__('Clear filters')}}
            </x-button.secondary>
        </div>
    </div>
    @if($showModal)
        <x-modal maxWidth="sm">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4" wire:ignore>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Sort filters and toggle visibility') }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ __('The first 3 filters will be shown by default, the rest will be hidden behind a toggle.') }}
                    </p>

                    <div class="mt-4 text-sm text-gray-600">
                        <div x-data="dragDropFilters()">
                            <template x-for="(column, index) in draggableColumns" :key="column.label">
                                <div>
                                    <div
                                        @dragstart="startDrag($event, index)"
                                        @dragover.prevent
                                        @dragenter="dragEnter($event, index)"
                                        @dragleave="dragLeave($event)"
                                        @drop="drop($event, index)"
                                        @dragend="endDrag($event)"
                                        class="flex items-center px-1 py-1 transition-all duration-300 cursor-pointer draggable-column"
                                        draggable="true"
                                    >
                                        <x-icon.eye
                                            class="w-5 h-5 mr-2 text-gray-600"
                                            x-show="column.visible"
                                            @click="toggleVisibility(column)"
                                        />
                                        <x-icon.eye-slash
                                            class="w-5 h-5 mr-2 text-gray-600"
                                            x-show="!column.visible"
                                            @click="toggleVisibility(column)"
                                        />
                                        <span x-text="column.label" class="pointer-events-none"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <p class="mt-2 text-gray-500">
                            {{ __('Drag and drop to reorder columns. Click the eye icon to toggle visibility.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
                <x-button.secondary wire:click="toggleFilterSettingsModal">
                    {{ __('Close') }}
                </x-button.secondary>
            </div>
        </x-modal>


    @endif
</div>
