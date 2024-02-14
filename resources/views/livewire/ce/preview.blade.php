<div class="flex justify-center">

    <div style="border: 1px solid #000;max-width: 325px;width:100%;font-size:12px;line-height:1.2;font-family:Arial;">
        <div style="text-align:center;border-bottom: 1px solid #000;">
            <div style="height:50px;"></div>
            <img src="{{ asset('images/ce-mark.png') }}" alt="CE" style="width:auto;height:40px;margin:0 auto 35px;display:block;">
            <div style="text-align:center;height:20px;">
                <x-tooltip-word :tooltip="__('The notified body\'s identification number')">{{ setting('ce_identification_number') }}</x-tooltip-word>
            </div>
            <div style="height:50px;"></div>
        </div>
        <div style="text-align:center;border-bottom: 1px solid #000;padding: 5px 0;">
            <x-tooltip-word :tooltip="__('Manufacturer\'s address')"> {!! nl2br(setting('ce_company_address')) !!}</x-tooltip-word>
            <div style="margin-top: 25px;font-weight:bold;height:20px;">
                <x-tooltip-word
                    :tooltip="__('Last two digits of the year of the year in which the marking is applied')"
                >{{ now()->format('y') }}</x-tooltip-word>
            </div>
            <div style="height:20px;margin-top:10px;">
                <x-tooltip-word
                    :tooltip="__('The certificate number')"
                >{{ setting('ce_certificate_number') }}</x-tooltip-word>
            </div>
        </div>
        <div style="padding: 25px 10px;text-align:left;">
            <div style="text-align:center;font-weight:bold;">
                <x-tooltip-word
                    :tooltip="__('Standard of execution')"
                >{{ $form->data->standard }}</x-tooltip-word>
            </div>
            <div style="text-align:center;margin-top:10px;">
                <x-tooltip-word
                    :tooltip="__('Describe what the CE mark includes')"
                >{{ $form->data->scope }}</x-tooltip-word>

            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Tolerances for Geometric Data')}}:
                <x-tooltip-word
                    :tooltip="__('Tolerance Class')"
                >{{ $form->data->tolerance_class }}</x-tooltip-word>
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Weldability')}}:
                    <x-tooltip-word
                        :tooltip="__('Weldability')"
                    >{{ (is_array(optional($form->data)->weldability) ? implode(', ', $form->data->weldability) : '') }} </x-tooltip-word>
                    {{__('according to')}}
                    <x-tooltip-word
                        :tooltip="__('Technical Delivery Conditions')"
                    >{{ (is_array(optional($form->data)->technical_delivery_conditions) ? implode(', ', $form->data->technical_delivery_conditions) : '') }}</x-tooltip-word>

            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Fracture toughness')}}:
                    <x-tooltip-word
                        :tooltip="__('Fracture Toughness')"
                    >{{ (is_array(optional($form->data)->fracture_toughness) ? implode(', ', $form->data->fracture_toughness) : '') }}</x-tooltip-word>
                    {{__('according to')}}

            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Behavior in Fire: Material Classification: Class')}}
                    <x-tooltip-word
                    :tooltip="__('Behavior in Fire')"
                >{{ $form->data->behavior_in_fire }}</x-tooltip-word>

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
                @if(preg_match('/^P/i', $form->data->machining_quality))
                    {{ __('Surface preparation according to EN 1090-2, Preparation grade') }} <x-tooltip-word :tooltip="__('Machining Quality')">{{ $form->data->machining_quality }}</x-tooltip-word>.

                    @if($form->data->surface == 'paint')
                        {{ __('Surface painted according to EN ISO 12944-5,')}}
                    @elseif($form->data->surface == 'galvanization')
                        {{ __('Surface galvanized according to EN ISO 1461,')}}
                    @elseif($form->data->surface == 'untreated')
                        {{ __('Surface untreated,')}}
                    @endif
                    <x-tooltip-word :tooltip="__('Durability')">{{ $form->data->durability }}</x-tooltip-word>.
                @else
                    {{ $form->data->machining_quality }}.
                @endif
            </div>
            <div style="margin-top:10px;font-weight:bold;">
                <div style="text-decoration:underline;">{{__('Structural Characteristics')}}:</div>
                <div>
                    <span style="text-decoration:underline">{{ __('Load bearing capacity')}}:</span>
                    @if(in_array($form->data->method, ['Method 2', 'Method 3b']))
                        <x-tooltip-word :tooltip="__('Load bearing capacity')">{{ $form->data->load_bearing_capacity }}</x-tooltip-word>
                    @else
                        {{ __('NPD') }}
                    @endif
                </div>
                <div>
                    <span style="text-decoration:underline">{{ __('Manufacturing')}}:</span>
                    {{ __('According to component specification') }}
                    <x-tooltip-word :tooltip="__('Project')">
                        @if($form->project_id)
                            @php($project = App\Models\Project::find($form->project_id))
                            {{ $project->data['number'] }} -  {{ $project->data['name'] }}
                        @endif
                    </x-tooltip-word>,
                    {{ __('and') }} <x-tooltip-word :tooltip="__('Execution Standard')">{{ $form->data->execution_standard }}</x-tooltip-word>. <x-tooltip-word :tooltip="__('Execution Class')">{{ $form->data->execution_class }}</x-tooltip-word>.
                </div>
            </div>

        </div>
    </div>

</div>
