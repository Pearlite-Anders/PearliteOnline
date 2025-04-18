@props([
    'heading',
    'buttons',
    'search',
    'compressed_header' => false,
    'hide_search_on_mobile' => true,
])

<div class="items-center justify-between block p-4 bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0">
    <div class="w-full mb-1 text-black @if($compressed_header) flex items-center justify-between @endif">
        <div class="my-2 md:my-4">
            <h1 class="flex items-center m-0 text-xl font-semibold leading-7 text-gray-900 sm:text-2xl sm:leading-8">
                {{ $heading}}
            </h1>

        </div>
        <div class="relative items-start sm:flex sm:space-x-2">
            <div class="items-center flex-grow @if($hide_search_on_mobile) mb-3 hidden sm:mb-0 sm:flex @else flex mb-0 @endif">
                @if(isset($search))
                    {{ $search }}
                @endif
            </div>
            @if (isset($buttons))
                <div class="flex items-center justify-end ml-auto space-x-2 @if($compressed_header) flex-grow @endif">
                    {{ $buttons }}
                </div>
            @endif
        </div>
    </div>
</div>
