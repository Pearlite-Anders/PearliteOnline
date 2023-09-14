
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-4 py-2 mx-0 font-semibold text-sm text-center text-white rounded-lg cursor-pointer bg-cyan-700 sm:w-auto hover:bg-cyan-800']) }}>
    {{ $slot }}
</button>
