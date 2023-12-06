<div>
    <div
        x-data='signature_editor(
            @json($form->new_certificate ? $form->new_certificate->temporaryUrl()  : ( $form->current_file ? $form->current_file->temporary_url() : null)),
            @json(url("/")),
            @json(optional($form->data)["signature_boxes"]) ?? [],
        )'
    >
        <x-button.secondary
            @click="open = true"
        >{{ __('Signature editor') }}</x-button.secondary>

        <!-- Modal -->
        <div
            x-show="open"
            style="display: none"
            x-on:keydown.escape.prevent.stop="open = false"
            role="dialog"
            aria-modal="true"
            x-id="['modal-title']"
            :aria-labelledby="$id('modal-title')"
            class="fixed inset-0 z-50 overflow-y-auto"
        >
            <!-- Overlay -->
            <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Panel -->
            <div
                x-show="open" x-transition
                x-on:click="open = false"
                class="relative flex items-center justify-center min-h-screen p-4"
            >
                <div
                    x-on:click.stop
                    x-trap.noscroll.inert="open"
                    class="relative w-full max-w-4xl p-12 overflow-y-auto bg-white shadow-lg rounded-xl"
                >
                    <div class="flex justify-between">
                        <div class="">
                            <x-button.secondary
                                @click="addSignatureBoxes(3)"
                            >{{ __('Add 3 signature boxes') }}</x-button.secondary>
                            <x-button.secondary
                                x-on:click="addSignatureBoxes(6)"
                            >{{ __('Add 6 signature boxes') }}</x-button.secondary>
                            <x-button.secondary
                                @click="clearBoxes()"
                            >{{ __('Clear boxes') }}</x-button.secondary>
                        </div>

                        <div x-show="total_pages > 1" class="flex space-x-2">
                            <x-button.secondary
                                @click="prevPage()"
                            >{{ __('Prev Page') }}</x-button.secondary>
                            <x-button.secondary
                                @click="nextPage()"
                            >{{ __('Next Page') }}</x-button.secondary>
                        </div>
                    </div>
                    <div id="signature-editor"></div>
                    <div x-show="loading" class="flex items-center justify-center w-full aspect-video">
                        <!-- loading svg -->
                        <svg class="w-8 h-8 text-gray-900 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex space-x-2">
                            <div class="flex items-center px-4 py-2 text-white rounded" style="background:#0097b2;">{{ __('Date') }}</div>
                            <div class="flex items-center px-4 py-2 text-white rounded" style="background:#FF3131;">{{ __('Signature') }}</div>
                            <div class="flex items-center px-4 py-2 text-white rounded" style="background:#00bf63;">{{ __('Title') }}</div>
                        </div>
                        <x-button.primary
                            type="button"
                            @click="save(true)"
                        >
                            {{ __('Save') }}
                        </x-button.primary>
                    </div>

                </div>
                <canvas id="pdf-canvas" class="hidden"></canvas>
            </div>
        </div>
    </div>
</div>
