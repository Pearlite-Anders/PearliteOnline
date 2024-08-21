<div>
    <x-form-header backlink="{{ route('welder.index') }}">
        <x-slot name="title">{{ __('View document') }}</x-slot>
    </x-form-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="md:flex">
            <div class="container p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
                {{ $document->data["content"] }}
            </div>
            <div class="flex grow justify-center">
                <div>
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
                        <ul class="list-none text-gray-900">
                            <li>
                                <a href="#" class="flex gap-x-4 items-center">
                                    <x-icon.pencil class="h-4 w-4" />
                                    <span>Edit</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex gap-x-4 items-center text-red-600">
                                    <x-icon.trash class="h-4 w-4" />
                                    <span>Delete</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
