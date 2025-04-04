<div>
    <h2 class="truncate text-lg text-gray-900 mb-4">{{ $header }} <span wire:loading.remove>({{ $totalTasks }})</span></h2>
    <div wire:loading>
        <x-loading>{{ __('Loading tasks...') }}</x-loading>
    </div>
    <div wire:loading.remove>
        <div class="w-full max-w-7xl">
            @if ($tasks->count() == 0 || $totalTasks == 0)
                <p class="text-sm text-gray-500">
                    {{ __('You haven’t any open tasks.') }} <br />
                    {{ __('Good work!, keep it up.') }} {{ __('Or maybe you should check your filters') }}
                </p>
            @else
                <x-table>
                    <x-slot name="head">
                        <x-table.heading class="text-left">{{ __('Module') }}</x-table.heading>
                        <x-table.heading class="text-left">{{ __('Subject') }}</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($tasks as $module => $moduleTasks)
                            @foreach($moduleTasks as $task)
                                <x-table.row
                                    :edit_link="$task->edit_url()"
                                    :can_edit="true"
                                    class="cursor-pointer hover:bg-gray-50"
                                >
                                    <x-table.cell class="py-4">{{ \App\Livewire\Dashboard\Module::from($module)->label() }}</x-table.cell>
                                    <x-table.cell class="py-4">{{ $task->data['name'] ?? '' }}</x-table.cell>
                                </x-table.row>
                            @endforeach
                        @endforeach
                    </x-slot>
                </x-table>
            @endif
        </div>
    </div>
</div>
