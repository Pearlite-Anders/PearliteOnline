<div class="flex space-x-2">
    @foreach($filterColumns->slice(1, 3) as $filter)
        @php($filter_column = $model::getColumn($filter->key))
        @if($filter_column->type == 'select')
            <div class="relative mt-1 lg:w-64 xl:w-64">
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
    @endforeach
</div>
