<?php
/**
 * Attributes
 * - $column: array
 *  - type: string
 *  - label: string
 *  - dependencies: array
 *  - create_popup: boolean
 *  - help: string
 *  - class: string
 *  - relationship: string
 *  - placeholder: string
 *  - default: string
 *  - options: string
 *  - multiple: boolean
 *  - select_first: boolean
 *  - prefix: string
 *  - postfix: string
 *  - npd_button: boolean
 *  - info: string
 *  - restrictions: array
 *   - view: array
 *   - edit: array
 *  - container: array
*   - class: string
 * - $form: object
 */
?>

@if(isset($column['restrictions']) && !in_array(auth()->user()->role, $column['restrictions']['view']))
    @php
        return;
    @endphp
@endif
@if($column['type'] == 'company')
    @php
        return;
    @endphp
@endif
@if (isset($column['container']))
    <div class="{{ $column['container']['class'] }}">
@endif
<div
    class="
        @if(in_array($column['type'], ['textarea', 'rich_text'])) md:col-span-3 @endif
        @if(optional($column)['dependencies'])
            @foreach($column['dependencies'] as $dependency => $values)
                @if(
                    !$form->data->{$dependency} ||
                    !in_array($form->data->{$dependency}, $values)
                )
                    hidden
                @endif
            @endforeach
        @endif
        md:col-span-1
    "
>
    @unless(
        optional($column)['create_popup'] ||
        $column['type'] == 'group'
    )
        <div class="flex mb-2 item-center">
            <x-label for="{{ $key }}" :value="__($column['label'])" class="!mb-0" />
            @if(optional($column)['help'])
                <x-tooltip-question-mark :tooltip="$column['help']" class="h-4 ml-1 mt-[2px]" />
            @endif
            @if(optional($column)['required'])
                <span class="text-red-400">*</span>
            @endif
        </div>
    @endunless
    @if($column['type'] == 'relationship' && optional($column)['create_popup'])
        <livewire:relationship-field-with-create
            :$column
            wire:model.live="form.{{$key}}"
        />
    @elseif($column['type'] == 'relationship')
        <x-input.choices
            class="block w-full mt-1"
            :selected="$form->{$key}"
            wire:model="form.{{$key}}"
            :options="$column['class']::get_choices([auth()->user()->currentCompany->id])"
            prettyname="{{ $key }}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
        />
    @elseif($column['type'] == 'dynamic_relationship' && optional($column)['create_popup'])
        <livewire:dynamic-relationship-field-with-create
            :$column
            :foreign_key="$form->{$column['foreign_key']}"
            wire:model.live="form.{{$key}}"
        />
    @elseif($column['type'] == 'dynamic_relationship')
        <livewire:dynamic-relationship-field
            :$column
            :relation="$form->{$column['relationship']}"
            wire:model.live="form.{{$key}}"
        />
    @elseif($column['type'] == 'group')
        <livewire:group-field
            :$column
            wire:model.live="form.data.{{$key}}"
            wire:key="{{ $key }}"
        />
    @elseif($column['type'] == 'calculated')
        <x-input
            value="{{ $this->{$key} }}"
            disabled
        />
    @elseif($column['type'] == 'date')
        <x-input.date
            wire:model="form.data.{{ $key }}"
            :value="optional($form->data)->{$key}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
        />
    @elseif($column['type'] == 'calculated_date')
        <x-input.date
            wire:model="form.data.{{ $key }}"
            :value="$this->{$key}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
        />
    @elseif($column['type'] == 'select')
        @php
            $options = is_array($column['options']) ? $column['options'] : App\Models\Setting::get($column['options']);
            if(optional($column)['prefix']) {
                $options = array_map(function($item) use ($column) {
                    return __($column['prefix']) . $item;
                }, $options);
            }

            if(optional($column)['postfix']) {
                $options = array_map(function($item) use ($column) {
                    return $item . __($column['postfix']);
                }, $options);
            }

            $selected = optional($form->data)->{$key} ?? ($column['default'] ?? '' );
        @endphp
        <x-input.choices
            class="block w-full mt-1"
            wire:model="form.data.{{ $key }}"
            :options="$options"
            :selected="$selected"
            prettyname="{{ $key }}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
            :multiple="$column['multiple']"
            :selectFirst="optional($column)['select_first']"
        />
    @elseif($column['type'] == 'radios')
        <x-input.radios
            class="block w-full mt-1 whitespace-nowrap"
            wire:model="form.data.{{ $key }}"
            :options="is_array($column['options']) ? $column['options'] : App\Models\Setting::get($column['options'])"
            :selected="optional($form->data)->{$key} ?? ($column['default'] ?? '' )"
        />
    @elseif($column['type'] == 'checkbox')
        <x-input.toggle
            wire:model="form.data.{{ $key }}"
            :initial_value="optional($form->data)->{$key}"
        />
    @elseif($column['type'] == 'rich_text')
        <x-input.rich-text
            wire:model="form.data.{{$key}}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
            rows="5"
        />

    @elseif($column['type'] == 'textarea')
        <x-input.textarea
            wire:model="form.data.{{$key}}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
            rows="5"
        />
    @elseif($column['type'] == 'system_text')
        <div
            x-data="{readonly: true}"
            x-effect="readonly = $wire.form.data.{{$key}} && $wire.form.data.{{$key}}.length > 0 ? false : true"
        >
            <div x-show="readonly" class="relative">
                @php($class = 'block w-full leading-tight border-gray-300 rounded-md shadow-sm bg-gray-50 placeholder:text-gray-400 placeholder:text-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')
                @if(optional($column)['prefix'])
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">{{ $column['prefix'] }}</span>
                    </div>
                    @php($class .= ' pl-5')
                @endif
                <input
                    readonly
                    type="text"
                    class="{{ $class }} cursor-not-allowed text-gray-500"
                    value="{{ $column['default'] }}"
                >
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 space-x-2">
                    @if(optional($column)['npd_button'])
                        <button
                            type="button"
                            x-on:click="readonly = false;$wire.form.data.{{$key}} = 'NPD';$wire.$refresh()"
                            class="px-2 py-1 text-xs leading-none text-gray-500 border border-gray-300 rounded hover:border-cyan-300 hover:text-cyan-300"
                        >
                         {{ __('NPD') }}
                        </button>
                    @endif

                    <button
                        type="button"
                        x-on:click="readonly = false; $wire.form.data.{{$key}} = '{{ $column['default'] }}'; $focus.focus($refs.input);$wire.$refresh()"
                        class="text-gray-500 sm:text-sm hover:text-cyan-300"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>


                    @if(optional($column)['postfix'])
                        <span class="text-gray-500 pointer-events-none sm:text-sm">{{$column['postfix'] }}</span>
                    @endif
                </div>
            </div>
            <div x-show="!readonly">
                <x-input
                    :live="isset($live)"
                    wire:model="form.data.{{$key}}"
                    placeholder="{{ __($column['placeholder'] ?? '') }}"
                    postfix="{{ __($column['postfix'] ?? '') }}"
                    prefix="{{ __($column['prefix'] ?? '') }}"
                    x-ref="input"
                />
            </div>
        </div>
    @elseif($column['type'] == 'time')
        <x-input.time
            wire:model="form.data.{{ $key }}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
            :value="optional($form->data)->{$key}"
        />
    @else
        <x-input
            :live="isset($column['live']) && $column['live']"
            wire:model="form.data.{{$key}}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
            postfix="{{ __($column['postfix'] ?? '') }}"
            prefix="{{ __($column['prefix'] ?? '') }}"
            required="$column['prefix'] ?? false"
            :disabled="isset($column['disabled_by']) && !($form->data->toArray()[$column['disabled_by']] ?? false)"
        />
    @endif

    <!-- has help -->
    @if(optional($column)['info'])
        <p class="mt-1 text-sm text-gray-500">{{ __($column['info']) }}</p>
    @endif
</div>
@if (isset($column['container']))
    </div>
@endif
