<div class="flex justify-center">

    <div style="border: 1px solid #000;max-width: 400px;width:100%;font-size:12px;line-height:1.2;font-family:Arial;">
        <div style="text-align:center;border-bottom: 1px solid #000;">
            <div style="height:50px;"></div>
            <img src="{{ asset('images/ce-mark.png') }}" alt="CE" style="width:auto;height:40px;margin:0 auto 35px;display:block;">
            <div style="text-align:center;height:20px;">
                <span
                    x-data
                    x-tooltip="{{__('The notified body\'s identification number')}}"
                    class="border-b border-gray-500 border-dotted cursor-help"
                >{{ setting('ce_identification_number') }}</span>
            </div>
            <div style="height:50px;"></div>
        </div>
        <div style="text-align:center;border-bottom: 1px solid #000;padding: 5px 0;">
            <span
                x-data
                x-tooltip="{{__('Manufacturer\'s address')}}"
                class="border-b border-gray-500 border-dotted cursor-help"
            >{!! nl2br(setting('ce_company_address')) !!}</span>
            <div style="margin-top: 25px;font-weight:bold;height:20px;">
                <span
                    x-data
                    x-tooltip="{{__('Last two digits of the year of the year in which the marking is applied') }}"
                    class="border-b border-gray-500 border-dotted cursor-help"
                >{{ now()->format('y') }}</span>
            </div>
            <div style="height:20px;margin-top:10px;">
                <span
                    x-data
                    x-tooltip="{{__('The certificate number') }}"
                    class="border-b border-gray-500 border-dotted cursor-help"
                >{{ setting('ce_certificate_number') }}</span>
            </div>
        </div>
        <div style="padding: 25px 10px;text-align:left;">
            <div style="text-align:center;font-weight:bold;">
                <span
                    x-data
                    x-tooltip="{{__('Standard of execution') }}"
                    class="border-b border-gray-500 border-dotted cursor-help"
                >{{ $form->data->standard }}</span>
            </div>
            <div style="text-align:center;margin-top:10px;">
                {{ $form->data->scope }}
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Tolerances for Geometric Data')}}: {{ $form->data->tolerance_class }}
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Weldability')}}: {{ (is_array(optional($form->data)->weldability) ? implode(', ', $form->data->weldability) : '') }} {{__('according to')}} {{ (is_array(optional($form->data)->technical_delivery_conditions) ? implode(', ', $form->data->technical_delivery_conditions) : '') }}
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Fracture toughness')}}: {{ (is_array(optional($form->data)->fracture_toughness) ? implode(', ', $form->data->fracture_toughness) : '') }}
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Behavior in Fire: Material Classification: Class')}} {{ $form->data->behavior_in_fire }}
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Release of Cadmium')}}: {{ setting('ce_release_of_cadmium') }}
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Emission of Radioactivity')}}: {{ setting('ce_emission_of_radioactivity') }}
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Durability')}}:
                @if(preg_match('/^P/i', $form->data->machining_quality))
                    {{ sprintf(__('Surface preparation according to EN 1090-2, Preparation grade %s. Surface painting according to EN ISO 12944-5, %s.'), $form->data->machining_quality, $form->data->durability) }}
                @else
                    {{ $form->data->machining_quality }}.
                @endif
            </div>
            <div style="margin-top:10px;font-weight:bold;">
                <div style="text-decoration:underline;">{{__('Structural Characteristics')}}:</div>
                <div>
                    <span style="text-decoration:underline">{{ __('Load bearing capacity')}}:</span>
                    @if(in_array($form->data->method, ['Method 2', 'Method 3b']))
                        {{ $form->data->load_bearing_capacity }}
                    @else
                        {{ __('NPD') }}
                    @endif
                </div>
                <div>
                    <span style="text-decoration:underline">{{ __('Manufacturing')}}:</span>
                    {{ sprintf(__('According to component specification %s, and %s. %s'), $form->data->manufacturing, $form->data->execution_standard, $form->data->execution_class) }}
                </div>
            </div>

        </div>
    </div>

</div>
