<div class="flex" x-data @click.prevent.stop="console.log('stop')">
    <button
        class="flex items-center justify-center w-6 h-6 text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
        type="button"
        wire:click="toggleModal"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    </button>

    @if($show_modal)
        <div
            class="fixed inset-0 z-10 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                    aria-hidden="true"
                    wire:click="toggleModal"
                ></div>

                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                >&#8203;</span>

                <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="modal-headline"
                >
                    <div class="grid grid-cols-1 p-4 gap-x-4 gap-y-8 md:p-6 md:grid-cols-3">
                        @foreach($model->loadAll()->toArray() as $label => $value)
                            <div>
                                <label class="block text-sm font-medium leading-5 text-gray-900">
                                    {{ $label}}
                                </label>
                                <div>
                                    {!! $value !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6">
                        <span class="flex justify-between w-full">
                            <x-button.secondary wire:click="toggleModal">
                                {{ __('Close') }}
                            </x-button.secondary>

                            @if($can_edit)
                                <x-button.primary
                                    href="{{ $edit_link }}"
                                    @click.prevent.stop="window.location.href = '{{ $edit_link }}'"
                                >
                                    {{ __('Edit') }}
                                </x-button.primary>
                            @endif
                        </span>
                </div>
            </div>
        </div>
    @endif


</div>
