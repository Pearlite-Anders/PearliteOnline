<div>
    <x-form-header backlink="{{ route('documents.index') }}">
        <x-slot name="title">
            @if ($parentDocument)
                {{ __('Create document under') }} {{ $parentDocument->currentRevision->data["title"] }}
            @else
                {{ __('Create document') }}
            @endif
        </x-slot>
    </x-form-header>
    <form
        class="px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="create"
    >
        @include('livewire.document.form')
        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary type="submit" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-button.primary>
            </div>
        </div>
    </form>
</div>
