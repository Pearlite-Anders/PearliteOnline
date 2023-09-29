<div>
    <div
      class="items-center justify-between block p-4 leading-6 text-black bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0"
    >
      <div class="flex items-center text-black">
        <div class="pr-3">
            <x-button.secondary href="{{ route('users.index') }}" class="inline-flex justify-center">
                <x-icon.left-arrow class="block w-6 h-6 align-middle" />
            </x-button.secondary>
        </div>
        <div class="flex pl-4 text-gray-500 border-l border-gray-100 border-solid">
          {{ __('New user') }}
        </div>
      </div>
    </div>
    <form
        class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="create"
    >
        @include('livewire.user.form')
        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary>
                    {{ __('Create') }}
                </x-button.primary>
            </div>
        </div>
    </form>
</div>
