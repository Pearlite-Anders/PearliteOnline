@props([
    'file',
    'svg_location' => 'top',
    'hide_name' => false,
    'with_delete' => false,
])

<div x-data="{ open: false }" class="inline-flex">
    @if($svg_location == 'left')
        <div
            class="cursor-pointer"
            @click="open = true"
        >
            <div class="flex items-center w-full overflow-hidden rounded-lg group aspect-[1/1] focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                <img
                    src="{{ $file->temporary_url() }}"
                    alt="{{ $file->name }}"
                    class="object-cover pointer-events-none group-hover:opacity-75"
                >
                </div>
                @if(!$hide_name)
                    <p class="block mt-2 text-sm font-medium text-gray-900 truncate pointer-events-none">
                        {{ $file->name }}
                    </p>
                @endif
            @if($with_delete)
                <x-button.delete
                    wire:click="deleteFile({{ $file->id }})"
                    wire:loading.attr="disabled"
                    class="ml-2"
                >
                    {{ __('Delete') }}
                </x-button.delete>
            @endif
        </div>
    @else
        <div
            class="inline-flex flex-col items-center text-sm cursor-pointer"
            @click="open = true"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="{{ $icon_class }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>

            @if(!$hide_name)
                {{ $file->name }}
            @endif
        </div>
    @endif

    <!-- Modal -->
    <div
        x-show="open"
        style="display: none"
        x-on:keydown.escape.prevent.stop="open = false"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-50 overflow-y-auto"
    >
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

        <!-- Panel -->
        <div
            x-show="open" x-transition
            x-on:click="open = false"
            class="relative flex items-center justify-center min-h-screen p-4"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="open"
                class="relative w-full max-w-6xl p-12 overflow-y-auto bg-white shadow-lg rounded-xl"
            >
                @if($file->isPDF())
                    <iframe
                        src="{{ $file->temporary_url() }}#navpanes=0"
                        frameborder="0"
                        class="w-full aspect-[1/1.4]"
                    ></iframe>
                @elseif($file->isImage())
                    <img src="{{ $file->temporary_url() }}" alt="{{ $file->name }}" />
                @endif
            </div>
        </div>
    </div>
</div>
