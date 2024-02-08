<div
    class="rounded-md shadow-sm"
    x-data="{
        value: @entangle($attributes->wire('model')),
        isFocused() { return document.activeElement !== this.$refs.trix },
        setValue() { this.$refs.trix.editor.loadHTML(this.value) },
    }"
    x-init="$watch('value', () => isFocused() && setValue()); setTimeout(() => setValue(), 100)"
    x-on:trix-change="value = $event.target.value"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
>
    <input id="x" type="hidden">
    <trix-editor
        @trix-attachment-add="uploadImage($event)"
        @trix-file-accept="acceptFile($event)"
        @trix-attachment-remove="removeImage($event)"
        x-ref="trix"
        input="x"
        placeholder="{{ $attributes->get('placeholder', '') }}"
        class="border-gray-300 rounded-md shadow-sm bg-gray-50 placeholder:text-gray-400 placeholder:text-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    ></trix-editor>

    <script>
        function uploadImage(event) {
            const attachment = event.attachment;
            @this.upload('trix_files', attachment.file, (uploadedFilename) => {
                const eventName = `trix-attachment-add:${btoa(uploadedFilename)}`;
                const listener = function(event) {
                    attachment.setAttributes({
                        url: event.detail[0],
                        href: event.detail[0]
                    });
                    window.removeEventListener(eventName, listener);
                };

                window.addEventListener(eventName, listener);

                @this.call('completeUpload', uploadedFilename, eventName);

            }, () => {
                // Error callback...
            }, (event) => {
                attachment.setUploadProgress(event.detail.progress);
            }, () => {
                // Cancelled callback...
            })
        }

        function acceptFile(event) {
            const acceptedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!acceptedTypes.includes(event.file.type)) {
                event.preventDefault();
                alert("{{ __('Only support attachment of jpeg or png files') }}");
            }
        }

        function removeImage(event) {
            @this.call('removeTrixUpload', event.attachment.attachment.previewURL);
        }
    </script>
</div>
