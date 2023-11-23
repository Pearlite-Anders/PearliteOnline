<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Welding certificate') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\WeldingCertificate::SYSTEM_COLUMNS as $key => $column)
            @if($column['type'] == 'welding_certificate') @continue @endif
            <div>
                <x-label for="{{ $key }}" :value="__($column['label'])" />
                @if($column['type'] == 'relationship')
                    <x-input.choices
                        class="block w-full mt-1"
                        :selected="$form->{$key}"
                        wire:model="form.{{$key}}"
                        :options="$column['class']::get_choices()"
                        prettyname="{{ $key }}"
                        placeholder="{{ $column['placeholder'] ?? '' }}"
                    />
                @elseif($column['type'] == 'calculated')
                    <x-input
                        value="{{ $this->{$key} }}"
                        disabled
                    />
                @elseif($column['type'] == 'date')
                    <x-input.date
                        wire:model="form.data.{{ $key }}"
                        :value="optional($form->data)[$key]"
                        placeholder="{{ $column['placeholder'] ?? '' }}"
                    />
                @elseif($column['type'] == 'select')
                    <x-input.choices
                        class="block w-full mt-1"
                        wire:model="form.data.{{ $key }}"
                        :options="is_array($column['options']) ? $column['options'] : App\Models\Setting::get($column['options'])"
                        :selected="optional($form->data)[$key] ?? []"
                        prettyname="{{ $key }}"
                        placeholder="{{ $column['placeholder'] ?? '' }}"
                        :multiple="$column['multiple']"
                    />
                @else
                    <x-input
                        wire:model="form.data.{{$key}}"
                        placeholder="{{ $column['placeholder'] ?? '' }}"
                        postfix="{{ $column['postfix'] ?? '' }}"
                        prefix="{{ $column['prefix'] ?? '' }}"
                    />
                @endif
            </div>
        @endforeach

    </div>
</div>

<div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Certificate') }}
        </h3>
        <div class="grid grid-cols-1 gap-6 mb-6">
            <x-input.filepond
                wire:model="form.new_certificate"
            />
        </div>

        @if ($form->current_file)
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <div class="inline-flex flex-col items-center">
                        <x-file-with-modal
                            :file="$form->current_file"
                            :path="$form->current_file->temporary_url()"
                        />

                        <div class="flex mt-2 space-x-4">
                            @include('livewire.welding-certificates.signature-editor')
                            <livewire:welding-certificates.signer  :file="$form->current_file" :welding_certificate="$weldingCertificate" />
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Previous certificates') }}
        </h3>
        @if (isset($weldingCertificate) && $weldingCertificate->previous_files)
            <div class="overflow-auto max-h-[215px]">
                <ul>
                    @foreach(array_reverse($weldingCertificate->previous_files) as $file_id)
                        @php( $file = \App\Models\File::find($file_id) )
                        <li class="py-1">
                            <x-file-with-modal
                                :file="$file"
                                svg_location="left"
                            />
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>
