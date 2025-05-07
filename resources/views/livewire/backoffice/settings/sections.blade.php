

<aside class="hidden px-6 pt-8 border-b border-gray-900/5 lg:block lg:w-80 lg:flex-none lg:border-0">
    <nav class="flex-none px-4 sm:px-6 lg:px-0" aria-label="Sidebar">
        <ul role="list" class="-mx-2 space-y-1">
            @can('viewAny', App\Models\TimeRegistration::class)
                <li class="mt-2 mb-0 text-left list-outside">
                    <x-nav-link wire:click="setSection('time-registration')" :active="$section == 'time-registration'">
                        <x-icon.time-registration class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                        {{ __('Time Registration') }}
                    </x-nav-link>
                </li>
            @endif
        </ul>
    </nav>
</aside>
