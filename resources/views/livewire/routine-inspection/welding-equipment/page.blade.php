
<div>
    <div class="rounded-lg bg-white py-8 h-full">
        <h2 class="font-medium text-gray-900 truncate text-md px-8 mb-4">{{ _('Weldering Equipment') }}</h2>

        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($equipments as $equipment)
                <li class="flex justify-between gap-x-6 py-2 px-8">
                    <div class="flex min-w-0 gap-x-4 ">
                        <!-- <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""> -->
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm text-gray-900">{{ $settings[$equipment->id] ?? 'missing?' }}</p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm text-gray-900">{{ $equipment->latest_inspect_date }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
