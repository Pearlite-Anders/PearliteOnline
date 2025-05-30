@php
    $filestypes = isset($attributes['filetypes']) ? $attributes['filetypes'] : [];
    if (!is_array($filestypes)) {
        $filestypes = [$filestypes];
    }
    $filetypes = implode("', '", $filestypes);
    if (!empty($filetypes)) {
        $filetypes = "'" . $filetypes . "'";
    }
@endphp
<div
    wire:ignore
    x-data
    x-init="
        pond = FilePond.create($refs.input);
        pond.setOptions({
            allowFileTypeValidation: {{ count($filestypes) >= 1 ? 'true' : 'false' }},
            acceptedFileTypes: [{{ $filetypes }}],
            credits: false,
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
