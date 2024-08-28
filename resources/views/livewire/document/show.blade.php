<div>
    <x-form-header backlink="{{ route('documents.index') }}">
        <x-slot name="title">{{ __('View document') }}</x-slot>
    </x-form-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="lg:flex">
            <div class="max-w-5xl px-4 py-2 mb-4 leading-7 bg-white rounded-lg shadow xl:px-10 xl:py-8 sm:px-8 sm:py-6">
                <h1 class="mb-4 text-3xl font-medium tracking-tight">{{ $document->data["title"] }}</h1>
                <div class="text-base">
                    {!! $document->data["content"] !!}
                </div>
            </div>
            <div class="flex grow lg:justify-center text-nowrap">
                <div class="px-4">
                    <div class="mb-6">
                        <h2 class="mb-2 text-lg text-gray-900">{{ __('Details') }}</h2>
                        <ul class="text-gray-900 list-none">
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
                        <h2 class="mb-2 text-lg text-gray-900">{{ __('Actions') }}</h2>
                        <ul class="text-gray-900 list-none hover:text-black">
                            <li>
                                <a
                                   href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                   class="flex items-center gap-x-4"
                                >
                                    <x-icon.pencil class="w-4 h-4" />
                                    <span>Edit</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                    @if($confirming == true)
                                        <x-button
                                            wire:click="delete()"
                                            class="px-1 bg-red-600 hover:bg-red-800"
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
                                            class="flex items-center text-red-600 bg-transparent gap-x-4 hover:text-red-800"
                                        >
                                            <x-icon.trash class="w-4 h-4" />
                                            <span>Delete</span>
                                        </button>
                                    @endif
                                </div>
                                <!-- <a href="#" class="flex items-center text-red-600 gap-x-4">
                                    <x-icon.trash class="w-4 h-4" />
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
