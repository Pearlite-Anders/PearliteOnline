@props(['disabled' => false])
@php
    foreach($attributes as $key => $value) {
        if($key == 'value') {
            $attributes[$key] = __($value);
        }
    }
@endphp

<div wire:ignore>
    <div
        x-data
        x-init="() => {
            window.ChoicesArray = window.ChoicesArray || {};
            window.ChoicesArray['{{ $attributes['prettyname'] }}'] = new Choices($refs.{{ $attributes['prettyname'] }}, {
                removeItems: true,
                removeItemButton: true,
                allowHTML: false,
                noResultsText: '{{ __('No results found') }}',
                noChoicesText: '{{ __('No choices to choose from') }}',
                itemSelectText: '{{ __('Press to select') }}',
                uniqueItemText: '{{ __('Only unique values can be added') }}',
                customAddItemText: '{{ __('Only values matching specific conditions can be added') }}',
                placeholderValue: '{{ $attributes['placeholder'] }}',
            });

            window.ChoicesArray['{{ $attributes['prettyname'] }}'].passedElement.element.addEventListener('change', function(event) {
                values = getSelectValues($refs.{{ $attributes['prettyname'] }});
                if(values !== '{{ $attributes['placeholder'] }}') {
                    @this.set('{{ $attributes['wire:model'] }}', values);
                } else {
                    @this.set('{{ $attributes['wire:model'] }}', '');
                }
                var input = window.ChoicesArray['{{ $attributes['prettyname'] }}'].input;
                if (window.ChoicesArray['{{ $attributes['prettyname'] }}'].getValue(true).length > 0) {
                    if (input) {
                        input.placeholder = '';
                        setTimeout(function() {
                            input.element.style.width = 3 + 'ch';
                        }, 50);
                    }
                } else {
                    var input = window.ChoicesArray['{{ $attributes['prettyname'] }}'].input;
                    if (input) {
                        input.placeholder = '{{ $attributes['placeholder'] }}';
                        input.element.style.width = input.element.placeholder.length + 1 + 'ch';
                    }
                }
            },false);

            items = {!! str_replace('"', "'", json_encode($attributes['selected'], JSON_HEX_APOS)) !!};

            if(Array.isArray(items)) {
                items.forEach(function(select) {
                    window.ChoicesArray['{{ $attributes['prettyname'] }}'].setChoiceByValue((select).toString());
                });
            } else {
                if(items) {
                    window.ChoicesArray['{{ $attributes['prettyname'] }}'].setChoiceByValue((items).toString());
                }
            }
            }
            function getSelectValues(select) {
                var result = [];
                var options = select && select.options;
                var opt;
                for (var i=0, iLen=options.length; i<iLen; i++) {
                    opt = options[i];
                    if (opt.selected) {
                        result.push(opt.value || opt.text);
                    }
                }
                if(select.multiple) {
                    return result;
                }

                return result[0];
            }


            $wire.on('refreshChoices', (param) => {
                if(param[2] == '{{ $attributes['prettyname'] }}') {
                    window.ChoicesArray['{{ $attributes['prettyname'] }}'].clearChoices();
                    window.ChoicesArray['{{ $attributes['prettyname'] }}'].setChoices(async () => {
                        return Object.keys(param[0]).map((item, index) => {
                            return {
                                value: item,
                                label: param[0][item]
                            }
                        });
                    }, 'value', 'label', true);
                    setTimeout(() => {
                        window.ChoicesArray['{{ $attributes['prettyname'] }}'].setChoiceByValue((param[1]).toString());
                    }, 100)
                }
            });

            $wire.on('changeChoice', (param) => {
                if(param[0] == '{{ $attributes['prettyname'] }}') {
                    window.ChoicesArray['{{ $attributes['prettyname'] }}'].setChoiceByValue((param[1]).toString());
                }
            });
        ">
        <select
            id="{{ $attributes['prettyname'] }}"
            wire-model="{{ $attributes['wire:model'] }}"
            @if($attributes['wire:change'])
                wire:change="{{ $attributes['wire:change'] }}"
            @endif
            x-ref="{{ $attributes['prettyname'] }}"
            @if($attributes['multiple'])
                multiple
            @endif
        >
            @if($attributes['placeholder'] && !isset($attributes['multiple'])
                <option value="">{{ $attributes['placeholder'] }}</option>
            @endif
            @if(count($attributes['options'])>0)
                @foreach($attributes['options'] as $key=>$option)
                    <option value="{{$key}}" >{{$option}}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
