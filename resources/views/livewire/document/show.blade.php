<div>
    <x-form-header backlink="{{ route('documents.index') }}">
        <x-slot name="title">{{ __('View document') }}</x-slot>
    </x-form-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="lg:flex">
            <nav class="flex flex-1 flex-col" aria-label="Subdocuments navigation">
                <ul role="list" class="space-y-1 px-8">
                    <x-document-tree-node :document="$treeRoot" :currentId="$document->id" />
                </ul>
            </nav>
            <div class="w-6/12 flex flex-col gap-4">
                @include('livewire.document._breadcrumb')
                <div class="flex flex-1 flex-col px-4 py-2 mb-4 leading-7 bg-white rounded-lg shadow xl:px-10 xl:py-8 sm:px-8 sm:py-6">
                    <h1 class="text-3xl font-medium mb-4 tracking-tight">{{ $revision->data["title"] }}</h1>
                    <div class="text-base">
                        {!! $revision->data["content"] !!}
                    </div>
                </div>
            </div>
            <div class="flex grow lg:justify-center text-nowrap">
                <div class="px-4">
                    <div class="mb-6">
                        <h2 class="text-lg text-gray-900 mb-2">{{ __('Details') }}</h2>
                        <ul class="list-none text-gray-900">
                            <li>
                                Revision: {{ $revision->created_at->format('Y-m-d H:i') }}
                            </li>
                            <li>
                                {{ _('Created at') }}: {{ $document->created_at->format('Y-m-d') }}
                            </li>
                            <li>
                                {{ _('Updated at') }}: {{ $document->updated_at->format('Y-m-d') }}
                            </li>
                        </ul>
                    </div>
                    @if($showActions)
                        <div>
                            <h2 class="text-lg text-gray-900 mb-2">{{ __('Actions') }}</h2>
                            <ul class="list-none text-gray-900 hover:text-black">
                                @if (auth()->user()->can('update', $document))
                                    <li>
                                        <a
                                        href="{{ route('documents.edit', ['document' => $document->id]) }}"
                                        class="flex gap-x-4 items-center"
                                        >
                                            <x-icon.pencil class="h-4 w-4" />
                                            <span>Edit</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->can('update', $document))
                                    <li>
                                        <a
                                        href="{{ route('document_revisions.index', ['document' => $document->id]) }}"
                                        class="flex gap-x-4 items-center"
                                        >
                                            <x-icon.eye class="h-4 w-4" />
                                            <span>Revisions</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->can('update', $document))
                                    <li>
                                        <a
                                        href="{{ route('documents.create', ['parent' => $document->id]) }}"
                                        class="flex gap-x-4 items-center"
                                        >
                                            <x-icon.plus class="!h-4 !w-4" />
                                            <span>Create sub document</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->can('update', $document))
                                    <li>
                                        <div class="flex flex-col" x-data @click.prevent.stop="console.log('stop')">
                                            @if($confirming == true)
                                                <p class="text-red-600">
                                                    This will delete this document. <br />
                                                    @if($document->descendants()->count() > 0)
                                                        And all {{ $document->descendants()->count() }} sub documents. <br />
                                                    @endif
                                                    Are you sure?
                                                </p>
                                                <div class="flex flex-row">
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
                                                </div>
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
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
