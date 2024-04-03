<div>
    <div class="flex justify-between">
        <x-label :value="__($column['label'])" />
        <button
            type="button"
            class="text-sm text-cyan-500 hover:text-blue-700"
            wire:click="$set('showCreatePopup', true)"
        >{{__('Create')}}</button>
    </div>

    <x-input.choices
        :multiple="isset($column['multiple']) ? $column['multiple'] : false"
        class="block w-full mt-1"
        :selected="$value"
        wire:model="value"
        :options="$choices"
        :prettyname="$column['key']"
        placeholder="{{ __($column['placeholder'] ?? '') }}"
    />

    @if($showCreatePopup)
        <x-modal maxWidth="lg" wire:model="showCreatePopup">
            <div class="p-4">
                <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                    {{ __($column['label']) }}
                </h3>
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-1">
                    @foreach($column['class']::SYSTEM_COLUMNS as $key => $column)
                        @if(in_array($column['type'], ['file', 'welding_certificate']) || optional($column)['hidden']) @continue @endif
                        @include('livewire.common.field')
                    @endforeach
                </div>
                <div class="flex justify-between">
                    <x-button.secondary wire:click="$set('showCreatePopup', false)">{{__('Cancel')}}</x-button>
                    <x-button.primary wire:click="create">{{__('Save')}}</x-button>
            </div>

        </x-modal>
    @endif


</div>
