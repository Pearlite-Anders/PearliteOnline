<div>
    <x-form-header>
        <x-slot name="title">{{ __('Z Value') }}</x-slot>
    </x-form-header>

    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <div class="grid grid-cols-1 gap-2 mb-6 md:gap-6 md:grid-cols-5">
                <div>
                    <x-label for="c" :value="__('Shape and Placement')" class="!mb-0 mt-2" />
                </div>
                <div class="md:col-span-4">
                    <fieldset class="flex flex-wrap mt-2 md:mt-0">
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shape"
                                wire:model.live="shape"
                                value="-25"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('-25 Butt weld') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shape"
                                wire:model.live="shape"
                                value="-10"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('-10 Corner joint') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shape"
                                wire:model.live="shape"
                                value="-5"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('-5 Buttering - Single bevel groove weld') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shape"
                                wire:model.live="shape"
                                value="0"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('0 Multi-pass groove weld') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shape"
                                wire:model.live="shape"
                                value="3"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('3 T-joint (middle of plate)') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shape"
                                wire:model.live="shape"
                                value="5"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('5 T-joint (near edge)') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shape"
                                wire:model.live="shape"
                                value="8"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('8 Corner assembly') }}</span>
                        </label>
                    </fieldset>
                </div>
                <div>
                    <x-label :value="__('Shrinkage Control')" class="!mb-0 mt-2" />
                </div>
                <div class="md:col-span-4">
                    <fieldset class="flex flex-wrap mt-2 md:mt-0">
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shrinkage"
                                wire:model.live="shrinkage"
                                value="0"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('0 Low shrinkage restraint') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shrinkage"
                                wire:model.live="shrinkage"
                                value="3"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('3 Medium shrinkage restraint') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="shrinkage"
                                wire:model.live="shrinkage"
                                value="5"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('5 High shrinkage restraint') }}</span>
                        </label>
                    </fieldset>
                </div>
                <div>
                    <x-label :value="__('Preheating')" class="!mb-0 mt-2" />
                </div>
                <div class="md:col-span-4">
                    <fieldset class="flex flex-wrap mt-2 md:mt-0">
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="preheating"
                                wire:model.live="preheating"
                                value="0"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('0 Without preheating') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="preheating"
                                wire:model.live="preheating"
                                value="-8"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('-8 Preheating > 100C') }}</span>
                        </label>

                    </fieldset>
                </div>
                <div>
                    <x-label :value="__('Static or Dynamic')" class="!mb-0 mt-2" />
                    <p class="text-xs text-gray-500">{{ __('Can be reduced by 50% for material affected in thickness direction under pressure due to predominantly static loading.') }}</p>
                </div>
                <div class="md:col-span-4">
                    <fieldset class="flex flex-wrap mt-2 md:mt-0">
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="static"
                                wire:model.live="static"
                                value="0.5"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('50% Static') }}</span>
                        </label>
                        <label class="has-[:checked]:ring-cyan-400 m-2 cursor-pointer text-sm has-[:checked]:text-semibold has-[:checked]:bg-slate-50  items-center rounded-lg px-4 py-2 ring-gray-300 ring-1 hover:bg-slate-100">
                            <input
                                type="radio"
                                name="static"
                                wire:model.live="static"
                                value="1"
                                class="w-4 h-4 mr-1 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600"
                            >
                            <span>{{ __('100% Dynamic') }}</span>
                        </label>

                    </fieldset>
                </div>
            </div>

            <div class="pt-12 mt-12 overflow-y-auto verflow-x-auto md:pt-8">
                <table class="table min-w-full table-fixed">
                    <thead>
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="{{ count($columns) }}" class="text-center">{{ __('Effective Material Thickness (s)') }}</th>
                        </tr>
                        <tr>
                            <th class="relative w-20 px-2 text-xs text-left">
                                <div class="absolute origin-bottom-left transform -rotate-[60deg] md:-rotate-45 w-28" style="padding-left:21px;bottom:-10px;">
                                    {{ __('Effective Depth of Weld a(eff)') }}
                                </div>
                            </th>
                            <th class="relative w-20 px-2 text-xs text-left">
                                <div class="absolute origin-bottom-left transform -rotate-[60deg] md:-rotate-45 w-28" style="padding-left:21px;bottom:-10px;">
                                    {{ __('Depth of Weld a-measurement') }}
                                </div>
                            </th>
                            @foreach($columns as $column)
                                <th class="w-20 px-2">{{ $column['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $row_index => $row)
                        <tr>
                            <td class="w-20 px-2 text-center">{{ $row['depth'] }}</td>
                            <td class="w-20 px-2 text-center">{{ $row['a'] }}</td>
                            @foreach($columns as $column_index => $column)
                                @php( $color_class = $this->values[$row_index][$column_index]['label'] == 'Z15' ? 'bg-green-200' : ($this->values[$row_index][$column_index]['label'] == 'Z25' ? 'bg-yellow-200' : ($this->values[$row_index][$column_index]['label'] == 'Z35' ? 'bg-red-200' : 'bg-slate-100')))
                                <td class="w-20 text-center px-2 {{ $color_class }}">
                                    {{ $this->values[$row_index][$column_index]['label'] }}
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
