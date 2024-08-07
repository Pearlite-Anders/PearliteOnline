<div>
    <div class="flex items-center mb-2">
        <x-label :value="__($column['label'])" class="!mb-0" />
        @if(optional($column)['multiple'])
            <button
                type="button"
                class="ml-4 text-sm text-cyan-500 hover:text-blue-700"
                wire:click="addRow"
            >{{__('Add')}}</button>
        @endif
    </div>

    <div class="space-y-2">
        @if(is_array($value))
            @foreach($value as $key => $item)
                <div
                    class="flex items-center space-x-2"
                    wire:key="{{ $key }}"
                >
                    @foreach($column['fields'] as $field_key => $field)
                        <div
                            class="w-full"
                            wire:key="{{ $field_key }}"
                        >
                            @if($field['type'] == 'select')
                                @php
                                    $options = is_array($field['options']) ? $field['options'] : App\Models\Setting::get($field['options']);
                                @endphp
                                <x-input.choices
                                    class="block w-full mt-1"
                                    wire:model="value.{{ $key }}.{{ $field_key }}"
                                    :options="$options"
                                    :selected="$item[$field_key]"
                                    prettyname="{{ $field_key }}"
                                    placeholder="{{ __($field['placeholder'] ?? '') }}"
                                    :multiple="$field['multiple']"
                                />
                            @endif
                        </div>
                    @endforeach
                    <div
                        class="flex items-center"
                        wire:key="delete-{{ $key }}"
                    >
                        <x-button
                            type="button"
                            class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                            wire:click="removeRow({{ $key }})"
                        >
                            <x-icon.trash class="w-4 h-4 text-red-600" />
                        </x-button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>


</div>
