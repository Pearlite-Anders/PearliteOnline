<div>
    <x-form-header backlink="{{ route('users.index') }}">
        <x-slot name="title">{{ __('Dependencies for user:') }} {{ $user->name }}</x-slot>
    </x-form-header>

    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 text-black border-t border-b-0 border-gray-200 border-solid border-x-0">
        <div class="mb-4 leading-6 text-black bg-white rounded-lg shadow py-4 sm:py-6 xl:py-8">
            <h3 class="px-4 sm:px-6 xl:px-8 mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                {{ __('Suppliers') }}
            </h3>
            <div class="flex flex-col leading-6 text-black">
                <div class="overflow-x-auto">
                    <div class="overflow-hidden">
                        <livewire:user.dependencies.supplier :user="$user"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 leading-6 text-black bg-white rounded-lg shadow py-4 sm:py-6 xl:py-8">
            <h3 class="px-4 sm:px-6 xl:px-8 mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                {{ __('Documents') }}
            </h3>
            <div class="flex flex-col leading-6 text-black">
                <div class="overflow-x-auto">
                    <div class="overflow-hidden">
                        <livewire:user.dependencies.document :user="$user"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
