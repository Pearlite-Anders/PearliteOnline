<div>
    <x-input.choices
        :multiple="isset($column['multiple']) ? $column['multiple'] : false"
        class="block w-full mt-1"
        :selected="$value"
        wire:model="value"
        :options="$choices"
        :prettyname="optional($column)['key']"
        placeholder="{{ __(optional($column)['placeholder'] ?? '') }}"
    />
</div>
