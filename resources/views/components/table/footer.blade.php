<td
    {{ $attributes->merge(['class' => 'px-6 py-3 bg-gray-50 whitespace-nowrap'])->only('class') }}
>
    <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">{{ $slot }}</span>
</td>
