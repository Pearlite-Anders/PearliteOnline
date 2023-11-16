<div>
    <x-button.secondary wire:click="toggleModal">
        <x-icon.columns class="w-6 h-6" />
    </x-button.secondary>

    @if($showModal)
        <x-modal maxWidth="sm">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Sort columns and toggle visibility') }}
                    </h3>

                    <div class="mt-4 text-sm text-gray-600">
                        <div x-data="dragDropColumns()">
                            <template x-for="(column, index) in draggableColumns" :key="column.label">
                                <div>
                                    <div
                                        @dragstart="startDrag($event, index)"
                                        @dragover.prevent
                                        @dragenter="dragEnter($event, index)"
                                        @dragleave="dragLeave($event)"
                                        @drop="drop($event, index)"
                                        @dragend="endDrag($event)"
                                        class="flex items-center px-1 py-1 transition-all duration-300 cursor-pointer draggable-column"
                                        draggable="true"
                                    >
                                        <x-icon.eye
                                            class="w-5 h-5 mr-2 text-gray-600"
                                            x-show="column.visible"
                                            @click="toggleVisibility(column)"
                                        />
                                        <x-icon.eye-slash
                                            class="w-5 h-5 mr-2 text-gray-600"
                                            x-show="!column.visible"
                                            @click="toggleVisibility(column)"
                                        />
                                        <span x-text="column.label" class="pointer-events-none"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <p class="mt-2 text-gray-500">
                            {{ __('Drag and drop to reorder columns. Click the eye icon to toggle visibility.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
                <x-button.secondary wire:click="toggleModal">
                    {{ __('Close') }}
                </x-button.secondary>
            </div>
        </x-modal>
    @endif
</div>

<script>
    function dragDropColumns() {
        return {
            draggableColumns: @entangle('columns'),
            draggingIndex: null,
            targetIndex: null,

            startDrag(event, index) {
                this.draggingIndex = index;
                event.dataTransfer.effectAllowed = 'move';
            },
            dragEnter(event, index) {
                this.targetIndex = index;
                event.target.closest('.draggable-column').classList.add('bg-gray-200');
            },
            dragLeave(event) {
                this.targetIndex = null;
                event.target.closest('.draggable-column').classList.remove('bg-gray-200');
            },
            drop(event, targetIndex) {
                if (this.draggingIndex !== null) {
                    this.$wire.$parent.call('reorderColumns', this.draggingIndex, targetIndex);
                }
                this.draggingIndex = null;
                this.targetIndex = null;
                event.target.closest('.draggable-column').classList.remove('bg-gray-200');
            },
            endDrag(event) {
                this.targetIndex = null;
                event.target.closest('.draggable-column').classList.remove('drag-over');
            },
            toggleVisibility(column) {
                this.$wire.$parent.call('toggleColumnVisibility', column.label);
            }
        };
    }
</script>
