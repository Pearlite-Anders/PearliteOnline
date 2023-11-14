@props(['disabled' => false])

<div x-data wire:ignore>
    <div
        x-data
        x-init="() => {
            var choices = new Choices($refs.{{ $attributes['prettyname'] }}, {
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('No results found') }}',
                noChoicesText: '{{ __('No choices to choose from') }}',
                itemSelectText: '{{ __('Press to select') }}',
                uniqueItemText: '{{ __('Only unique values can be added') }}',
                customAddItemText: '{{ __('Only values matching specific conditions can be added') }}',
                placeholderValue: '{{ $attributes['placeholder'] }}',
            });

            choices.passedElement.element.addEventListener('change', function(event) {
                    values = getSelectValues($refs.{{ $attributes['prettyname'] }});
                    @this.set('{{ $attributes['wire:model'] }}', values);
            },false);

            items = {!! str_replace('"', "'", json_encode($attributes['selected'], JSON_HEX_APOS)) !!};

            if(Array.isArray(items)) {
                items.forEach(function(select) {
                    choices.setChoiceByValue((select).toString());
                });
            } else {
                choices.setChoiceByValue((items).toString());
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

                console.log(result[0]);

                return result[0];
            }
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
