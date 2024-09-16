<div class="p-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6 mb-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Document') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\DocumentRevision::getColumns() as $key => $column)
            @include('livewire.common.field')
        @endforeach
    </div>
</div>

<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Permissions') }}
    </h3>

    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <div></div>
        <div class="hidden font-bold md:block">{{ __('View') }}</div>
        <div class="hidden font-bold md:block">{{ __('Edit') }}</div>

        <div class="text-lg font-bold italic">{{ __('Everyone') }}</div>

        <div class="flex items-center space-x-4 md:space-x-0">
            <label class="w-24 md:hidden">{{ __('View') }}</label>
            <button
                x-ref="toggle"
                wire:click="toggleAllViewPermission()"
                type="button"
                role="switch"
                aria-checked="{{ $form->data->default_view }}"
                class="relative inline-flex py-1 transition rounded-full w-14 {{ $form->data->default_view ? 'bg-cyan-600' : 'bg-slate-300' }}"
            >
                <span
                    class=" w-6 h-6 transition bg-white rounded-full shadow-md {{ $form->data->default_view ? 'translate-x-7' : 'translate-x-1' }}"
                    aria-hidden="true"
                ></span>
            </button>
        </div>


        <div class="flex items-center space-x-4 md:space-x-0">
            <label class="w-24 md:hidden">{{ __('View') }}</label>
            <button
                x-ref="toggle"
                wire:click="toggleAllEditPermission()"
                type="button"
                role="switch"
                aria-checked="{{ $form->data->default_edit }}"
                class="relative inline-flex py-1 transition rounded-full w-14 {{ $form->data->default_edit ? 'bg-cyan-600' : 'bg-slate-300' }}"
            >
                <span
                    class=" w-6 h-6 transition bg-white rounded-full shadow-md {{ $form->data->default_edit ? 'translate-x-7' : 'translate-x-1' }}"
                    aria-hidden="true"
                ></span>
            </button>
        </div>

        @foreach($form->permissions as $user_id => $user)
            <div class="text-lg font-bold" wire:key="username-{{ $user_id }}">{{ $user['name'] }}</div>
            <div wire:key="view-{{ $user_id }}">
                <div class="flex items-center space-x-4 md:space-x-0">
                    <label class="w-24 md:hidden">{{ __('View') }}</label>
                    @if ($form->data->default_view || $user['edit'])
                        <button
                            x-ref="toggle"
                            type="button"
                            role="switch"
                            aria-checked="true"
                            class="relative inline-flex py-1 transition rounded-full w-14 border border-slate-300 bg-slate-100"
                        >
                            <span
                                class="w-6 h-6 transition bg-slate-300 rounded-full shadow-sm translate-x-7"
                                aria-hidden="true"
                            ></span>
                        </button>
                    @else
                        <button
                            x-ref="toggle"
                            wire:click="togglePermission({{ $user_id }}, 'view')"
                            type="button"
                            role="switch"
                            aria-checked="{{ $user['view'] }}"
                            class="relative inline-flex py-1 transition rounded-full w-14 {{ $user['view'] ? 'bg-cyan-600' : 'bg-slate-300' }}"
                        >
                            <span
                                class="w-6 h-6 transition bg-white rounded-full shadow-md {{ $user['view'] ? 'translate-x-7' : 'translate-x-1' }}"
                                aria-hidden="true"
                            ></span>
                        </button>
                    @endif
                </div>
            </div>

            <div wire:key="edit-{{ $user_id }}">
                <div class="flex items-center space-x-4 md:space-x-0">
                    <label class="w-24 md:hidden">{{ __('Edit') }}</label>
                    @if ($form->data->default_edit)
                        <button
                            x-ref="toggle"
                            type="button"
                            role="switch"
                            aria-checked="true"
                            class="relative inline-flex py-1 transition rounded-full w-14 border border-slate-300 bg-slate-100"
                        >
                            <span
                                class="w-6 h-6 transition bg-slate-300 rounded-full shadow-sm translate-x-7"
                                aria-hidden="true"
                            ></span>
                        </button>
                    @else
                        <button
                            x-ref="toggle"
                            wire:click="togglePermission({{ $user_id }}, 'edit')"
                            type="button"
                            role="switch"
                            aria-checked="{{ $user['edit'] }}"
                            class="relative inline-flex py-1 transition rounded-full w-14 {{ $user['edit'] ? 'bg-cyan-600' : 'bg-slate-300' }}"
                        >
                            <span
                                class="w-6 h-6 transition bg-white rounded-full shadow-md {{ $user['edit'] ? 'translate-x-7' : 'translate-x-1' }}"
                                aria-hidden="true"
                            ></span>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
