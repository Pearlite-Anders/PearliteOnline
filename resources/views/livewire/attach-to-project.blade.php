<div>
    <x-button.secondary
        class="flex items-center"
        wire:click="$set('showModal', true)"
    >
        <x-icon.plus class="mr-2 -ml-1 align-middle" />
        {{ __('Attach to project') }}
    </x-button.secondary>

    @if($showModal)
        <x-modal maxWidth="sm">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Click on a project to attach') }}
                    </h3>

                    <div class="mt-4 text-gray-600">
                        @forelse($projects as $project)
                            <div
                                wire:click="attachModel({{$project->id}})"
                                class="flex items-center px-1 py-1 transition-all duration-300 cursor-pointer hover:bg-gray-100"
                            >
                                {{ $project->data['name'] }}
                            </div>
                        @empty
                            <p class="italic">{{ __('No projects to attach') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
                <x-button.secondary wire:click="$set('showModal', false)">
                    {{ __('Close') }}
                </x-button.secondary>
            </div>
        </x-modal>
    @endif
</div>
