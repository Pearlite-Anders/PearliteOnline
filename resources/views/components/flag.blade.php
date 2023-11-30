@if(auth()->user()->locale == 'en')
    <x-icon.en class="block w-5 h-5 mt-px text-gray-500 align-middle rounded-full" />
@else
    <x-icon.da class="block w-5 h-5 mt-px text-gray-500 align-middle rounded-full" />
@endif
