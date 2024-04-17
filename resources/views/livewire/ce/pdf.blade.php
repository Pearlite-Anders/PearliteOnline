<div style="margin: 100px auto 0; border: 1px solid #000;max-width: 423px;width:100%;font-size:12px;line-height:1.2;font-family:Arial;">
    <div style="text-align:center;border-bottom: 1px solid #000;">
        <div style="height:50px;"></div>
        <img src="{{ asset('images/ce-mark.png') }}" alt="CE" style="width:auto;height:40px;margin:0 auto 35px;display:block;">
        <div style="text-align:center;height:20px;">
            {{ setting('ce_identification_number') }}
        </div>
        <div style="height:50px;"></div>
    </div>
    <div style="text-align:center;border-bottom: 1px solid #000;padding: 5px 0;">
        {!! setting('ce_company_address') !!}, {!! setting('ce_company_zip') !!} {!! setting('ce_company_city') !!}
        <div style="margin-top: 25px;font-weight:bold;height:20px;">
            {{ now()->format('y') }}
        </div>
        <div style="height:20px;margin-top:10px;">
            {{ setting('ce_certificate_number') }}
        </div>
    </div>
    <div style="padding: 25px 10px;text-align:left;">
        <div style="text-align:center;font-weight:bold;">
            {{ optional($ce->data)['standard'] }}
        </div>
        <div style="text-align:center;margin-top:10px;">
            {{ optional($ce->data)['scope'] }}
        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Tolerances for Geometric Data')}}:
            {{ optional($ce->data)['tolerance_class'] }}
        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Weldability')}}:
            @if(optional($ce->data)['weldability_group'])
                {{ setting('ce_weldability_group')[$ce->data['weldability_group']][0] }}
                {{__('according to')}}
                {{ setting('ce_weldability_group')[$ce->data['weldability_group']][1] }}
            @endif
        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Fracture toughness')}}:
            @if(optional($ce->data)['weldability_group'])
                {{ setting('ce_weldability_group')[$ce->data['weldability_group']][2] }}
            @endif
        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Behavior in Fire: Material Classification: Class')}}
            {{ optional($ce->data)['behavior_in_fire'] }}

        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Release of Cadmium')}}:
            {{ setting('ce_release_of_cadmium') }}
        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Emission of Radioactivity')}}:
            {{ setting('ce_emission_of_radioactivity') }}

        </div>
        <div style="font-weight:bold;margin-top:10px;">
            {{__('Durability')}}:
            @if(
                preg_match('/^P/i', $ce->data['machining_quality']) ||
                $ce->data['surface'] == 'untreated' ||
                $ce->data['surface'] == 'galvanization'
            )
                @if($ce->data['surface'] != 'untreated' && $ce->data['machining_quality'] != 'npd')
                    {{ __('Surface preparation according to EN 1090-2, Preparation grade') }} {{ $ce->data['machining_quality'] }}.
                @endif

                @if($ce->data['surface'] == 'paint')
                    {{ __('Surface painted according to EN ISO 12944-5')}}
                @elseif($ce->data['surface'] == 'galvanization')
                    {{ __('Surface galvanized according to EN ISO 1461')}}
                @elseif($ce->data['surface'] == 'untreated')
                    {{ __('Surface untreated')}}
                @endif
                @if($ce->data['surface'] != 'untreated' && $ce->data['durability'] != 'npd')
                    , {{ $ce->data['durability'] }}.
                @endif
            @else
                {{ $ce->data['machining_quality'] }}.
            @endif
        </div>
        <div style="margin-top:10px;font-weight:bold;">
            <div style="text-decoration:underline;">{{__('Structural Characteristics')}}:</div>
            @if(in_array(optional($ce->data)['method'], ['Method 3a']))
                <div>
                    <span style="text-decoration:underline">{{ __('Dimensioning')}}:</span>
                    {{ __('According to') }} {{ optional($ce->data)['dimensioning'] }}
                </div>
            @endif
            @if(in_array(optional($ce->data)['method'], ['Method 1','Method 2', 'Method 3b']))
                <div>
                    <span style="text-decoration:underline">{{ __('Load bearing capacity')}}:</span>
                    @if(optional($ce->data)['load_bearing_capacity'])
                        {{ optional($ce->data)['load_bearing_capacity'] }}
                    @else
                        {{ App\Models\Ce::getColumn('load_bearing_capacity')->default }}
                    @endif
                </div>
            @endif
            @if(in_array(optional($ce->data)['method'], ['Method 2', 'Method 3b']))
                <div>
                    <span style="text-decoration:underline">{{ __('Deformation at serviceability limit state')}}:</span>
                    @if(optional($ce->data)['deformation_serviceability_limit_state'])
                        {{ optional($ce->data)['deformation_serviceability_limit_state'] }}
                    @else
                        {{ App\Models\Ce::getColumn('deformation_serviceability_limit_state')->default }}
                    @endif
                </div>
            @endif
            @if(in_array(optional($ce->data)['method'], ['Method 2', 'Method 3b']))
                <div>
                    <span style="text-decoration:underline">{{ __('Fatigue Strength') }}:</span>
                    @if(optional($ce->data)['fatigue_strength'])
                        {{ optional($ce->data)['fatigue_strength'] }}
                    @else
                        {{ App\Models\Ce::getColumn('fatigue_strength')->default }}
                    @endif
                </div>
            @endif
            @if(in_array(optional($ce->data)['method'], ['Method 2', 'Method 3b']))
                <div>
                    <span style="text-decoration:underline">{{ __('Resistance to fire') }}:</span>
                    @if(optional($ce->data)['fire_resistance'])
                        {{ optional($ce->data)['fire_resistance'] }}
                    @else
                        {{ App\Models\Ce::getColumn('fire_resistance')->default }}
                    @endif
                </div>
            @endif
            <div>
                <span style="text-decoration:underline">{{ __('Manufacturing')}}:</span>
                {{ __('According to component specification') }}
                @if($ce->project)
                    {{ $ce->project->data['number'] }} -  {{ $ce->project->data['name'] }}
                @endif
                {{ __('and') }} {{ optional($ce->data)['execution_standard'] }}. {{ optional($ce->data)['execution_class'] }}.
            </div>
        </div>

    </div>
</div>

@pageBreak

<div style="width: 750px;font-family:Arial;font-size:9pt;line-height:1;padding: 50px 75px;">
    <h2 style="font-size: 14pt;font-weight:bold;text-align:center;margin-bottom:5px;">{{ __('Declaration of performance') }}</h2>
    <div style="font-size: 10pt;font-style:italic;text-align:center;">{{ __('CPR 305/2011/EU') }}</div>
    <div style="margin-top:18px;">{{ __('1. Identification of the product type:') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('Structural metallic products and ancillaries') }}</div>
    <div style="margin-top:15px;">{{ __('2. Construction product:') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('According to') }}
        @if($ce->project)
            {{ $ce->project->data['number'] }} -  {{ $ce->project->data['name'] }}
        @endif
    </div>
    <div style="margin-top:18px;">{{ __('3. Intended use of the construction product:') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('Structural components for building and construction') }}</div>
    <div style="margin-top:18px;">{{ __('4. Manufacture and address') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ auth()->user()->currentCompany->data['name'] }} {!! setting('ce_company_address') !!}, {!! setting('ce_company_zip') !!} {!! setting('ce_company_city') !!}</div>
    <div style="margin-top:18px;">{{ __('5. Name and contact address of the authorized representative:') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('Irrelevant') }}</div>
    <div style="margin-top:18px;">{{ __('6. System of assessment and verification of constancy of performance of the construction product:') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('System 2+') }}</div>
    <div style="margin-top:18px;">{{ __('7. Name and identification number of the notified body covers by a harmonized standard:') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ setting('ce_identification_number') }}</div>
    <div style="margin-top:18px;">{{ __('8. Name and identification number of the notified body covers by a European Technical Assessment:') }}</div>
    <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('Irrelevant') }}</div>
    <div style="margin-top:18px;">{{ __('9. Declared Performance') }}</div>
    <table cellspacing="0" callpadding="0" style="width:100%;border: 1px solid #333;margin-top:15px;font-size:9pt;">
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 8px 2px;font-style:italic;">{{ __('Essential characteristic') }}</td>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 8px 2px;font-style:italic;">{{ __('Performance') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 8px 2px;font-style:italic;text-align:center;">{{ __('Harmonized standard') }}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Dimensions- and tolerances') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">{{ optional($ce->data)['tolerance_class'] }}</td>
            <td style="border-left: 1px solid #333;padding: 3px 2px;font-weight:bold;text-align:center;" rowspan="10">
                {{ optional($ce->data)['standard'] }}
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Weldability') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                @if(optional($ce->data)['weldability_group'])
                    {{ setting('ce_weldability_group')[$ce->data['weldability_group']][0] }}
                    {{__('according to')}}
                    {{ setting('ce_weldability_group')[$ce->data['weldability_group']][1] }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Fracture toughness') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                @if(optional($ce->data)['weldability_group'])
                    {{ setting('ce_weldability_group')[$ce->data['weldability_group']][2] }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Load bearing capacity') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                @if(optional($ce->data)['load_bearing_capacity'])
                    {{ optional($ce->data)['load_bearing_capacity'] }}
                @else
                    {{ App\Models\Ce::getColumn('load_bearing_capacity')->default }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Deformation at serviceability limit state') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                @if(optional($ce->data)['deformation_serviceability_limit_state'])
                    {{ optional($ce->data)['deformation_serviceability_limit_state'] }}
                @else
                    {{ App\Models\Ce::getColumn('deformation_serviceability_limit_state')->default }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Fatigue strength') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                @if(optional($ce->data)['fatigue_strength'])
                    {{ optional($ce->data)['fatigue_strength'] }}
                @else
                    {{ App\Models\Ce::getColumn('fatigue_strength')->default }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Resistance to fire') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                @if(optional($ce->data)['fire_resistance'])
                    {{ optional($ce->data)['fire_resistance'] }}
                @else
                    {{ App\Models\Ce::getColumn('fire_resistance')->default }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Release of cadmium') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                {{ setting('ce_release_of_cadmium') }}
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;border-right: 1px solid #333;padding: 3px 2px;">{{ __('Emission of radioactivity') }}</td>
            <td style="border-bottom: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                {{ setting('ce_emission_of_radioactivity') }}
            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #333;padding: 3px 2px;">{{ __('Durability') }}</td>
            <td style="padding: 3px 2px;font-weight:bold;">
                @if(
                    preg_match('/^P/i', $ce->data['machining_quality']) ||
                    $ce->data['surface'] == 'untreated' ||
                    $ce->data['surface'] == 'galvanization'
                )
                    @if($ce->data['surface'] != 'untreated' && $ce->data['machining_quality'] != 'npd')
                        {{ __('Surface preparation according to EN 1090-2, Preparation grade') }} {{ $ce->data['machining_quality'] }}.
                    @endif

                    @if($ce->data['surface'] == 'paint')
                        {{ __('Surface painted according to EN ISO 12944-5')}}
                    @elseif($ce->data['surface'] == 'galvanization')
                        {{ __('Surface galvanized according to EN ISO 1461')}}
                    @elseif($ce->data['surface'] == 'untreated')
                        {{ __('Surface untreated')}}
                    @endif
                    @if($ce->data['surface'] != 'untreated' && $ce->data['durability'] != 'npd')
                        , {{ $ce->data['durability'] }}.
                    @endif
                @else
                    {{ $ce->data['machining_quality'] }}.
                @endif
            </td>
        </tr>
    </table>
    <div style="margin-top:18px;">{{ __('10. The performance of the product identified in points 1 and 2 is in conformity with the declared performance in point 9.') }}</div>
    <div style="margin-top:18px;">{{ __('This declaration of performance is issued under the sole responsibility of the manufacturer identified in point 4.') }}</div>

    <div style="margin-top:18px;">{{ __('Signed for and on behalf of the manufacturer by:') }}</div>
    <div style="display:flex;align-items:center;flex-direction:column;margin-top:10px;">
        <div>{{ auth()->user()->name }} - {{ auth()->user()->data['title'] }}</div>
        <div style="border-top: 1px dotted #333;width:200px;margin-top:5px;"></div>
        <div style="font-style:italic;margin-top:5px;">{{ __('Name and function') }}</div>
    </div>

    <div style="display:flex;justify-content: space-around;margin-top:10px;">
        <div style="display:flex;align-items:center;flex-direction:column;margin-top:10px;">
            <div>{!! setting('ce_company_city') !!} - {{ now()->format('Y-m-d') }}</div>
            <div style="border-top: 1px dotted #333;width:200px;margin-top:5px;"></div>
            <div style="font-style:italic;margin-top:5px;">{{ __('Place and date of issue') }}</div>
        </div>
        <div style="display:flex;align-items:center;flex-direction:column;margin-top:10px;">
            <div>&nbsp;</div>
            <div style="border-top: 1px dotted #333;width:200px;margin-top:5px;"></div>
            <div style="font-style:italic;margin-top:5px;">{{ __('Signature') }}</div>
        </div>

    </div>
</div>
