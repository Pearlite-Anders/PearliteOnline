@props([
    'placeholder' => null,
    'trailingAddOn' => null,
])

<div class="flex">
  <select {{ $attributes->merge(['class' => 'block w-full leading-tight p-2 m-0 text-base leading-6 text-gray-900 normal-case whitespace-pre bg-no-repeat border border-gray-300 border-solid rounded-lg appearance-none cursor-default bg-gray-50 sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2' . ($trailingAddOn ? ' rounded-r-none' : '')]) }}>
    @if ($placeholder)
        <option disabled value="">{{ $placeholder }}</option>
    @endif

    {{ $slot }}
  </select>

  @if ($trailingAddOn)
    {{ $trailingAddOn }}
  @endif
</div>
