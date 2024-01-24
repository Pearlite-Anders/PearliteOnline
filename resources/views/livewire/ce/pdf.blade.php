<div style="margin: 25px auto 0; border: 1px solid #000;max-width: 400px;width:100%;font-size:12px;line-height:1.2;font-family:Arial;">
    <div style="text-align:center;border-bottom: 1px solid #000;">
        <div style="height:50px;"></div>
        <img src="{{ asset('images/ce-mark.png') }}" alt="CE" style="width:auto;height:40px;margin:0 auto 35px;display:block;">
        <div style="text-align:center;height:20px;">
            {{ setting('ce_identification_number') }}
        </div>
        <div style="height:50px;"></div>
    </div>
    <div style="text-align:center;border-bottom: 1px solid #000;padding: 5px 0;">
        <x-tooltip-word :tooltip="__('Manufacturer\'s address')"> {!! nl2br(setting('ce_company_address')) !!}</x-tooltip-word>
        <div style="margin-top: 25px;font-weight:bold;height:20px;">
            {{ now()->format('y') }}
        </div>
        <div style="height:20px;margin-top:10px;">
            {{ setting('ce_certificate_number') }}
        </div>
    </div>
    <div style="padding: 25px 10px;text-align:left;">
        <div style="text-align:center;font-weight:bold;">
            {{ $ce->data['standard'] }}
        </div>
        <div style="text-align:center;margin-top:10px;">
            <x-tooltip-word
                :tooltip="__('Describe what the CE mark includes')"
            >{{ $ce->data['scope'] }}</x-tooltip-word>

        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Tolerances for Geometric Data')}}:
            <x-tooltip-word
                :tooltip="__('Tolerance Class')"
            >{{ $ce->data['tolerance_class'] }}</x-tooltip-word>
        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Weldability')}}:

                {{ is_array(optional($ce->data['weldability']) ? implode(', ', $ce->data['weldability']) : '') }}
                {{__('according to')}}
                <x-tooltip-word
                    :tooltip="__('Technical Delivery Conditions')"
                >{{ is_array(optional($ce->data['technical_delivery_conditions']) ? implode(', ', $ce->data['technical_delivery_conditions']) : '') }}</x-tooltip-word>

        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Fracture toughness')}}:
                <x-tooltip-word
                    :tooltip="__('Fracture Toughness')"
                >{{ is_array(optional($ce->data['fracture_toughness']) ? implode(', ', $ce->data['fracture_toughness']) : '') }}</x-tooltip-word>
                {{__('according to')}}

        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Behavior in Fire: Material Classification: Class')}}
                <x-tooltip-word
                :tooltip="__('Behavior in Fire')"
            >{{ $ce->data['behavior_in_fire'] }}</x-tooltip-word>

        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Release of Cadmium')}}:
            <x-tooltip-word
                :tooltip="__('Release of Cadmium from CE Settings')"
            >{{ setting('ce_release_of_cadmium') }}</x-tooltip-word>
        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Emission of Radioactivity')}}:
            <x-tooltip-word
                :tooltip="__('Emission of Radioactivity from CE Settings')"
            >{{ setting('ce_emission_of_radioactivity') }}</x-tooltip-word>

        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Durability')}}:
            @if(preg_match('/^P/i', $ce->data['machining_quality']))
                {{ __('Surface preparation according to EN 1090-2, Preparation grade') }} <x-tooltip-word :tooltip="__('Machining Quality')">{{ $ce->data['machining_quality'] }}</x-tooltip-word>.
                {{ __('Surface painting according to EN ISO 12944-5,')}} <x-tooltip-word :tooltip="__('Durability')">{{ $ce->data['durability'] }}</x-tooltip-word>.
            @else
                {{ $ce->data['machining_quality'] }}.
            @endif
        </div>
        <div style="margin-top:10px;font-weight:bold;">
            <div style="text-decoration:underline;">{{__('Structural Characteristics')}}:</div>
            <div>
                <span style="text-decoration:underline">{{ __('Load bearing capacity')}}:</span>
                @if(in_array($ce->data['method'], ['Method 2', 'Method 3b']))
                    <x-tooltip-word :tooltip="__('Load bearing capacity')">{{ $ce->data['load_bearing_capacity'] }}</x-tooltip-word>
                @else
                    {{ __('NPD') }}
                @endif
            </div>
            <div>
                <span style="text-decoration:underline">{{ __('Manufacturing')}}:</span>
                {{ __('According to component specification') }} <x-tooltip-word :tooltip="__('Manufacturing')">{{ $ce->data['manufacturing'] }}</x-tooltip-word>,
                {{ __('and') }} <x-tooltip-word :tooltip="__('Execution Standard')">{{ $ce->data['execution_standard'] }}</x-tooltip-word>. <x-tooltip-word :tooltip="__('Execution Class')">{{ $ce->data['execution_class'] }}</x-tooltip-word>.
            </div>
        </div>

    </div>
</div>