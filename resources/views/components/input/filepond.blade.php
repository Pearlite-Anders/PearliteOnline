<div
    wire:ignore
    x-data
    x-init="
        pond = FilePond.create($refs.input);
        pond.setOptions({
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, (event) => {
                        progress(event.lengthComputable, event.loaded, event.total)
                    })
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                },
            }
        });

    "
>
    <input
        type="file"
        x-ref="input"
    />
</div>
