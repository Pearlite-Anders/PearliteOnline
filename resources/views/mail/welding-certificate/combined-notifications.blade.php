<x-mail::message>
# {{ __('Hello') }},


@if(isset($expirations->weldingCertificates))
{{
    sprintf(
        __('You have %s welding certificates that will expire in %s days.'),
        $expirations->weldingCertificates->count(),
        $expirations->notification_before_expiration
    )
}}

<x-mail::button
    :url="route('welding-certificates.index', ['filter[ids]' => $expirations->weldingCertificates->join(',')])"
>
    {{__('View welding certificates')}}
</x-mail::button>
@endif


@if(isset($verifications->weldingCertificates))
{{
    sprintf(
        __('You have %s welding certificates that need verification in %s days.'),
        $verifications->weldingCertificates->count(),
        $verifications->notification_before_verification
    )
}}
<x-mail::button
    :url="route('welding-certificates.index', ['filter[ids]' => $verifications->weldingCertificates->join(',')])"
>
    {{__('View welding certificates')}}
</x-mail::button>
@endif


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
