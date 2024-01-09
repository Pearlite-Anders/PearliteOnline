<div class="@if($column['type'] == 'textarea') md:col-span-3 @endif">
    <x-label for="{{ $key }}" :value="__($column['label'])" />
    @if($column['type'] == 'relationship')
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
            :value="optional($form->data)[$key]"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
        />
    @elseif($column['type'] == 'select')
        <x-input.choices
            class="block w-full mt-1"
            wire:model="form.data.{{ $key }}"
            :options="is_array($column['options']) ? $column['options'] : App\Models\Setting::get($column['options'])"
            :selected="optional($form->data)[$key] ?? []"
            prettyname="{{ $key }}"
            placeholder="{{ __($column['placeholder'] ?? '') }}"
            :multiple="$column['multiple']"
        />
    @elseif($column['type'] == 'radios')
        <x-input.radios
            class="block w-full mt-1"
            wire:model="form.data.{{ $key }}"
            :options="is_array($column['options']) ? $column['options'] : App\Models\Setting::get($column['options'])"
            :selected="optional($form->data)[$key] ?? ''"
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
