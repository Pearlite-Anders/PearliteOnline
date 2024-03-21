<link href="{{ asset('css/trix.css') }}" rel="stylesheet">

<div style="font-size:12px;line-height:1.2;font-family:Arial;">
    <div style="text-align:center;">
        <h1 style="font-size: 24px;margin-top: 150px;">{{ __('Welding Coordination') }}</h1>
        @if($weldingCoordination->project)
            <h2 style="font-size: 14px;margin: 25px 0;">{{ $weldingCoordination->project->name }}</h2>
        @endif
        <h2>{{ $weldingCoordination->data['purpose'] }}</h2>
        <h2>{{ $weldingCoordination->data['date'] }}</h2>
    </div>
</div>

@pageBreak

<div style="font-size:12px;line-height:1.2;font-family:Arial;">
    {!! $weldingCoordination->data['activity'] !!}
</div>
