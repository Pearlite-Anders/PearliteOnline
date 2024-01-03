@props([
    'heading',
    'buttons',
    'search',
])

<div class="items-center justify-between block p-4 bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0">
    <div class="w-full mb-1 text-black">
        <div class="my-2 md:my-4">
            <h1 class="flex items-center m-0 text-xl font-semibold leading-7 text-gray-900 sm:text-2xl sm:leading-8">
                {{ $heading}}
            </h1>

        </div>
        <div class="relative items-start sm:flex sm:space-x-2">
            <div class="items-center flex-grow hidden mb-3 sm:mb-0 sm:flex">
                @if(isset($search))
                    {{ $search }}
                @endif
            </div>
            @if (isset($buttons))
                <div class="flex items-center justify-end ml-auto space-x-2">
                    {{ $buttons }}
                </div>
            @endif
        </div>
    </div>
</div>
