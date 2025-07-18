@props([
    'document',
    'svg_location' => 'top',
    'hide_name' => false,
    'icon_class' => 'w-6 h-6',
    'with_delete' => false,
])

<div x-data="{ open: false }" class="inline-flex">
    @if($svg_location == 'left')
        <div
            class="inline-flex items-center text-sm cursor-pointer"
            @click="open = true"
        >
            @if ($slot->isEmpty())
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="{{ $icon_class }} mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            @else
                {{ $slot }}
            @endif
        </div>
    @else
        <div
            class="inline-flex flex-col items-center text-sm cursor-pointer"
            @click="open = true"
        >
            @if ($slot->isEmpty())
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="{{ $icon_class }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            @else
                {{ $slot }}
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
                {!! data_get($document?->currentRevision?->data, 'content', 'empty') !!}
            </div>
        </div>
    </div>
</div>
