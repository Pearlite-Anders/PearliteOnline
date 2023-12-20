@props([
    'icon' => null,
    'title' => null,
    'number' => null,
    'link' => null,
])

<div class="relative px-4 pt-5 @if($link) pb-12 @endif overflow-hidden bg-white rounded-lg shadow sm:px-6 sm:pt-6">
    <dt>
        @if($icon)
            <div class="absolute flex items-center justify-center w-12 h-12">
                {{ $icon }}
            </div>
        @endif
        <p class="@if($icon) ml-16 @endif text-sm font-medium text-gray-500 truncate">{{ $title }}</p>
    </dt>
    <dd class="flex items-baseline @if($link) pb-6 @endif @if($icon) ml-16 @endif sm:pb-7">
        <p class="text-2xl font-semibold text-gray-900">
            {{ $number}}
        </p>
        @if($link)
            <div class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6">
                <div class="text-sm">
                    <a
                        href="{{ $link }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500"
                    >{{ __('View') }}</a>
                </div>
            </div>
        @endif
    </dd>
</div>
