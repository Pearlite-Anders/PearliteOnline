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

            </div>
        </x-slot>
        <x-slot name="buttons">
            @can('create', App\Models\Document::class)
                <x-button.link href="{{ route('documents.create') }}" class="inline-flex items-center justify-center">
                    <x-icon.plus class="mr-2 -ml-1 align-middle" />
                    {{ __('Add Document') }}
                </x-button.link>
            @endcan
        </x-slot>
    </x-index-header>
    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <ul role="list" class="grid grid-cols-1 gap-6 mx-6 my-5 sm:grid-cols-3 lg:grid-cols-4">
                @foreach($documents as $document)
                    <li class="col-span-1 bg-white divide-y divide-gray-200 rounded-lg shadow">
                        <div class="flex items-center justify-between w-full p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="font-medium text-gray-900 truncate text-md"> {{ $document->currentRevision->data["title"] ?? "" }}</h3>

                                </div>
                                <div class="mt-1 text-sm text-gray-500 truncate">{{ $document->currentRevision->data["introduction"] ?? "&nbsp;" }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="flex -mt-px divide-x divide-gray-200">
                                <div class="flex flex-1 w-0">
                                    <a
                                        href="{{ route('documents.show', ['document' => $document->id]) }}"
                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-semibold text-gray-900 border border-transparent rounded-bl-lg gap-x-3"
                                    >
                                        <x-icon.eye class="w-5 h-5 text-gray-400" />
                                        {{ __('Read') }}
                                    </a>
                                </div>
                                @if (auth()->user()->can('update', $document))
                                    <div class="flex flex-1 w-0 -ml-px">
                                        <a
                                            href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                            class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-semibold text-gray-900 border border-transparent rounded-br-lg gap-x-3"
                                        >
                                            <x-icon.pencil class="w-5 h-5 text-gray-400" />
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
            </ul>
        </div>
    </div>
</div>
