@props(['canEdit' => false, 'editLink' => ''])
<tr
    {{ $attributes->merge(['class' => 'bg-white']) }}
    @if($canEdit)
        wire:click="gotoEdit('{{ $editLink }}')"
    @endif
>

    {{ $slot }}
</tr>
