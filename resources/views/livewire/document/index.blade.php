<div>
    <x-index-header :compressed_header="$compressed_header">
        <x-slot name="heading">
            <x-icon.book class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Documents') }}
        </x-slot>
        <x-slot name="search">
            <div class="grid w-full grid-cols-1 gap-4 pr-16 md:grid-cols-8">
                @unless($hide_search)
                    <div class="relative col-span-2">
                        <input
                            type="search"
                            wire:model.live.debounce.500ms="search"
                            class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                            placeholder="{{ __('Global search..') }}"
                        />
                    </div>
                @endunless
                @unless($hide_filters)
                    <x-table-filters :filters="$filters" :model="$model" :filter_columns="$filter_columns" :show_modal="$showFilterSettingsModal" />
                @endunless
            </div>
        </x-slot>
    </x-index-header>
    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-3 lg:grid-cols-4 mx-6 my-5">
                @foreach($documents as $document)
                    <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                        <div class="flex w-full items-center justify-between space-x-6 p-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="truncate text-sm font-medium text-gray-900"> {{ $document->data["title"] ?? "" }}</h3>

                                </div>
                                <p class="mt-1 truncate text-sm text-gray-500">{{ $document->data["introduction"] ?? "" }}</p>
                            </div>
                        </div>
                        <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="flex w-0 flex-1">
                            <a
                                href="{{ route('documents.show', ['document' => $document->id]) }}"
                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900"
                                wire:navigate
                            >
                                <x-icon.eye class="h-5 w-5 text-gray-400" />
                                {{ __('Read') }}
                            </a>
                            </div>
                            <div class="-ml-px flex w-0 flex-1">
                            <a href="#" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <x-icon.pencil class="h-5 w-5 text-gray-400" />
                                {{ __('Edit') }}
                            </a>
                            </div>
                        </div>
                        </div>
                    </li>
                    @endforeach
            </ul>
        </div>
    </div>
</div>
