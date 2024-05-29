<div class="flex justify-center">

    <div style="border: 1px solid #000;max-width: 423px;width:100%;font-size:12px;line-height:1.2;font-family:Arial;transform:scale(0.8)">
        <div style="text-align:center;border-bottom: 1px solid #000;">
            <div style="height:50px;"></div>
            <img src="{{ asset('images/ce-mark.png') }}" alt="CE" style="width:auto;height:40px;margin:0 auto 35px;display:block;">
            <div style="text-align:center;height:20px;">
                <x-tooltip-word :tooltip="__('The notified body\'s identification number')">{{ setting('ce_identification_number') }}</x-tooltip-word>
            </div>
            <div style="height:50px;"></div>
        </div>
        <div style="text-align:center;border-bottom: 1px solid #000;padding: 5px 0;">
            <x-tooltip-word :tooltip="__('Manufacturer')">{!! setting('ce_company') !!}</x-tooltip-word><br>
            <x-tooltip-word :tooltip="__('Manufacturer\'s address')">{!! setting('ce_company_address') !!}, {!! setting('ce_company_zip') !!} {!! setting('ce_company_city') !!}</x-tooltip-word>
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
                @if(optional($form->data)->weldability_group)
                    <x-tooltip-word :tooltip="__('Weldability')">
                            {{ setting('ce_weldability_group')[$form->data->weldability_group][0] }}
                    </x-tooltip-word>
                    {{__('according to')}}
                        <x-tooltip-word :tooltip="__('Technical Delivery Conditions')" >
                        {{ setting('ce_weldability_group')[$form->data->weldability_group][1] }}
                    </x-tooltip-word>
                @endif
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Fracture toughness')}}:
                @if(optional($form->data)->weldability_group)
                    <x-tooltip-word :tooltip="__('Fracture Toughness')">
                    {{ setting('ce_weldability_group')[$form->data->weldability_group][2] }}
                    </x-tooltip-word>
                @endif
            </div>
            <div style="font-weight:bold;margin-top:10px;">
                {{__('Reaction to fire: Material Classification: Class')}}
                <x-tooltip-word
                    :tooltip="__('Reaction to fire')"
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
                @if(
                    preg_match('/^P/i', $form->data->machining_quality) ||
                    $form->data->surface == 'untreated' ||
                    $form->data->surface == 'galvanization'
                )
                    @if($form->data->surface != 'untreated' && $form->data->machining_quality != 'npd')
                        {{ __('Surface preparation according to EN 1090-2, Preparation grade') }} <x-tooltip-word :tooltip="__('Machining Quality')">{{ $form->data->machining_quality }}</x-tooltip-word>.
                    @endif

                    @if($form->data->surface == 'paint')
                        {{ __('Surface painted according to EN ISO 12944-5')}}
                    @elseif($form->data->surface == 'galvanization')
                        {{ __('Surface galvanized according to EN ISO 1461')}}
                    @elseif($form->data->surface == 'untreated')
                        {{ __('Surface untreated')}}
                    @endif
                    @if($form->data->surface != 'untreated' && $form->data->durability != 'npd')
                        , <x-tooltip-word :tooltip="__('Durability')">{{ $form->data->durability }}</x-tooltip-word>.
                    @endif
                @else
                    {{ $form->data->machining_quality }}.
                @endif
            </div>
            <div style="margin-top:10px;font-weight:bold;">
                <div style="text-decoration:underline;">{{__('Structural Characteristics')}}:</div>
                @if(in_array($form->data->method, ['Method 3a']))
                    <div>
                        <span style="text-decoration:underline">{{ __('Dimensioning')}}:</span>
                        {{ __('According to') }} <x-tooltip-word :tooltip="__('Dimensioning')">{{ $form->data->dimensioning }}</x-tooltip-word>
                    </div>
                @endif
                @if(in_array($form->data->method, ['Method 1','Method 2', 'Method 3b']))
                    <div>
                        <span style="text-decoration:underline">{{ __('Load bearing capacity')}}:</span>
                        <x-tooltip-word :tooltip="__('Load bearing capacity')">
                            @if($form->data->load_bearing_capacity)
                                {{ $form->data->load_bearing_capacity }}
                            @else
                                {{ App\Models\Ce::getColumn('load_bearing_capacity')->default }}
                            @endif
                        </x-tooltip-word>
                    </div>
                @endif
                @if(in_array($form->data->method, ['Method 2', 'Method 3b']))
                    <div>
                        <span style="text-decoration:underline">{{ __('Deformation at serviceability limit state')}}:</span>
                        <x-tooltip-word :tooltip="__('Deformation at serviceability limit state')">
                            @if($form->data->deformation_serviceability_limit_state)
                                {{ $form->data->deformation_serviceability_limit_state }}
                            @else
                                {{ App\Models\Ce::getColumn('deformation_serviceability_limit_state')->default }}
                            @endif
                        </x-tooltip-word>
                    </div>
                @endif
                @if(in_array($form->data->method, ['Method 2', 'Method 3b']))
                    <div>
                        <span style="text-decoration:underline">{{ __('Fatigue Strength') }}:</span>
                        <x-tooltip-word :tooltip="__('Deformation at serviceability limit state')">
                            @if($form->data->fatigue_strength)
                                {{ $form->data->fatigue_strength }}
                            @else
                                {{ App\Models\Ce::getColumn('fatigue_strength')->default }}
                            @endif
                        </x-tooltip-word>
                    </div>
                @endif
                @if(in_array($form->data->method, ['Method 2', 'Method 3b']))
                    <div>
                        <span style="text-decoration:underline">{{ __('Resistance to fire') }}:</span>
                        <x-tooltip-word :tooltip="__('Deformation at serviceability limit state')">
                            @if($form->data->behavior_in_fire)
                                {{ $form->data->behavior_in_fire }}
                            @else
                                {{ App\Models\Ce::getColumn('behavior_in_fire')->default }}
                            @endif
                        </x-tooltip-word>
                    </div>
                @endif
                <div>
                    <span style="text-decoration:underline">{{ __('Manufacturing')}}:</span>
                    {{ __('According to component specification') }}
                    <x-tooltip-word :tooltip="__('Project')">
                        @if($form->project_id)
                            @php($project = App\Models\Project::find($form->project_id))
                            @if($project)
                                {{ $project->data['number'] }} -  {{ $project->data['name'] }}
                            @endif
                        @endif
                    </x-tooltip-word>,
                    {{ __('and') }} <x-tooltip-word :tooltip="__('Execution Standard')">{{ $form->data->execution_standard }}</x-tooltip-word>. <x-tooltip-word :tooltip="__('Execution Class')">{{ $form->data->execution_class }}</x-tooltip-word>.
                </div>
            </div>

        </div>
    </div>

</div>
