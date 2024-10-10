<div>
    <div wire:loading>
        <x-loading>{{ _('Loading tasks...') }}</x-loading>
    </div>
    <div wire:loading.remove>
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8 max-w-7xl">
            @forelse($tasks as $module => $moduleTasks)
                @forelse($moduleTasks as $task)
                    <a class="overflow-hidden rounded-lg bg-white shadow" href="{{ route($module . '.edit', [$module => $task->id]) }}">
                        <div class="px-4 py-3 sm:px-6 sm:py-4">
                            <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mb-3">{{ $module }}</span>
                            <p>{{ __('Its time for assesment of') }}: {{ $task->data['name'] }}</p>
                        </div>
                    </a>
                @empty
                    <p class="my-4 text-sm text-gray-500">
                        {{ _('You haven’t any open tasks.') }} <br />
                        {{ _('Good work!, keep it up.') }} {{ _('Or maybe you should check your filters') }}
                    </p>
                @endforelse
            @empty
                <p class="text-sm text-gray-500">
                    {{ _('You haven’t selected any modules.') }}
                </p>
            @endforelse
        </div>
    </div>
</div>
