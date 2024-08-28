<div>
    <x-form-header backlink="{{ route('documents.index') }}">
        <x-slot name="title">{{ __('View document') }}</x-slot>
    </x-form-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="lg:flex">
            <div class="max-w-5xl px-4 py-2 mb-4 leading-7 bg-white rounded-lg shadow xl:px-10 xl:py-8 sm:px-8 sm:py-6">
                <h1 class="text-3xl font-medium mb-4 tracking-tight">{{ $document->data["title"] }}</h1>
                <div class="text-base">
                    {!! $document->data["content"] !!}
                </div>
            </div>
            <div class="flex grow lg:justify-center text-nowrap">
                <div class="px-4">
                    <div class="mb-6">
                        <h2 class="text-lg text-gray-900 mb-2">{{ __('Details') }}</h2>
                        <ul class="list-none text-gray-900">
                            <li>
                                Revsion: #1
                            </li>
                            <li>
                                {{ _('Created at') }}: {{ $document->created_at->format('Y-m-d') }}
                            </li>
                            <li>
                                {{ _('Updated at') }}: {{ $document->updated_at->format('Y-m-d') }}
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="text-lg text-gray-900 mb-2">{{ __('Actions') }}</h2>
                        <ul class="list-none text-gray-900 hover:text-black">
                            <li>
                                <a
                                   href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                   class="flex gap-x-4 items-center"
                                >
                                    <x-icon.pencil class="h-4 w-4" />
                                    <span>Edit</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                    @if($confirming == true)
                                        <x-button
                                            wire:click="delete()"
                                            class="bg-red-600 hover:bg-red-800 px-1"
                                        >
                                            <x-icon.check class="w-4 h-4 text-white" />
                                        </x-button>
                                        <x-button
                                            wire:click="cancelConfirmDelete"
                                            class="bg-cyan-600 hover:bg-cyan-700"
                                        >
                                            <x-icon.x class="w-4 h-4 text-white" />
                                        </x-button>
                                    @else
                                        <button
                                            wire:click="confirmDelete()"
                                            class="bg-transparent flex gap-x-4 items-center text-red-600 hover:text-red-800"
                                        >
                                            <x-icon.trash class="w-4 h-4" />
                                            <span>Delete</span>
                                        </button>
                                    @endif
                                </div>
                                <!-- <a href="#" class="flex gap-x-4 items-center text-red-600">
                                    <x-icon.trash class="h-4 w-4" />
                                    <span>Delete</span>
                                </a> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
