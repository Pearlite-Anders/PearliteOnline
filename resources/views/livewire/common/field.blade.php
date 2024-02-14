<div
    class="
        @if(in_array($column['type'], ['textarea', 'rich_text'])) md:col-span-3 @endif
        @if(optional($column)['dependencies'])
            @foreach($column['dependencies'] as $dependency => $values)
                @if($form->data->{$dependency} && !in_array($form->data->{$dependency}, $values))
                    hidden
                @endif
            @endforeach
        @endif
    "
    :key="$key"
>
    @unless(optional($column)['create_popup'])
        <div class="flex mb-2 item-center">
            <x-label for="{{ $key }}" :value="__($column['label'])" class="!mb-0" />
            @if(optional($column)['help'])
                <x-tooltip-question-mark :tooltip="$column['help']" class="h-4 ml-1 mt-[2px]" />
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
            :options="$column['class']::get_choices()"
            prettyname="{{ $key }}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
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
            class="block w-full mt-1"
            wire:model="form.data.{{ $key }}"
            :options="is_array($column['options']) ? $column['options'] : App\Models\Setting::get($column['options'])"
            :selected="optional($form->data)->{$key} ?? ($column['default'] ?? '' )"
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
    @else
        <x-input
            :live="isset($live)"
            wire:model="form.data.{{$key}}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
            postfix="{{ __($column['postfix'] ?? '') }}"
            prefix="{{ __($column['prefix'] ?? '') }}"
        />
    @endif
</div>
