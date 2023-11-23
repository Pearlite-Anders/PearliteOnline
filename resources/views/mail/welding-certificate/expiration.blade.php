<x-mail::message>
# {{ __('Hello') }},

{{ sprintf(__('You have %s welding certificates that will expire in %s days.'), $weldingCertificates->count(), $notification_before_expiration) }}

<x-mail::button
    :url="route('welding-certificates.index', ['filter[ids]' => $weldingCertificates->pluck('id')->join(',')])"
>
    {{__('View welding certificates')}}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
