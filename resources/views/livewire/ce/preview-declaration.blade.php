<div class="flex justify-center mt-4">
    <div style="width: 750px;font-family:Arial;font-size:9pt;border: 1px solid #333;line-height:1;zoom:0.5;padding: 50px 75px;">
        <h2 style="font-size: 14pt;font-weight:bold;text-align:center;margin-top:5px;margin-bottom:5px;">{{ __('Declaration of performance') }}</h2>
        <div style="font-size: 10pt;font-style:italic;text-align:center;">{{ __('CPR 305/2011/EU') }}</div>
        <div style="margin-top:18px;">{{ __('1. Identification of the product type:') }}</div>
        <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('Structural metallic products and ancillaries') }}</div>
        <div style="margin-top:15px;">{{ __('2. Construction product:') }}</div>
        <div style="font-weight:bold;text-align:center;margin-top:5px;">{{ __('According to') }}
            @if($form->project_id)
                @php($project = App\Models\Project::find($form->project_id))
                @if($project)
                    {{ $project->data['number'] }} -  {{ $project->data['name'] }}
                @endif
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
        <table cellspacing="0" callpadding="0" style="width:100%;border: 1px solid #333;margin-top:15px;">
            <tr>
                <td style="border: 1px solid #333;padding: 8px 2px;font-style:italic;">{{ __('Essential characteristic') }}</td>
                <td style="border: 1px solid #333;padding: 8px 2px;font-style:italic;">{{ __('Performance') }}</td>
                <td style="border: 1px solid #333;padding: 8px 2px;font-style:italic;text-align:center;">{{ __('Harmonized standard') }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Dimensions- and tolerances') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">{{ $form->data->tolerance_class }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;text-align:center;margin-top:5px;" rowspan="10">
                    {{ $form->data->standard }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Weldability') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    @if(optional($form->data)->weldability_group && is_array($form->data->weldability_group))
                        @foreach($form->data->weldability_group as $value)
                            @php($row = setting('ce_weldability_group')[$value])

                            {{ sprintf('%s according to %s', $row[0], $row[1]) }}
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Fracture toughness') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                @if(optional($form->data)->weldability_group && is_array($form->data->weldability_group))
                        @foreach($form->data->weldability_group as $value)
                            @php($row = setting('ce_weldability_group')[$value])

                            {{ $row[2] }}
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Load bearing capacity') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    @if($form->data->load_bearing_capacity)
                        {{ $form->data->load_bearing_capacity }}
                    @else
                        {{ App\Models\Ce::getColumn('load_bearing_capacity')->default }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Deformation at serviceability limit state') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    @if($form->data->deformation_serviceability_limit_state)
                        {{ $form->data->deformation_serviceability_limit_state }}
                    @else
                        {{ App\Models\Ce::getColumn('deformation_serviceability_limit_state')->default }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Fatigue strength') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    @if($form->data->fatigue_strength)
                        {{ $form->data->fatigue_strength }}
                    @else
                        {{ App\Models\Ce::getColumn('fatigue_strength')->default }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Resistance to fire') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    @if($form->data->behavior_in_fire)
                        {{ $form->data->behavior_in_fire }}
                    @else
                        {{ App\Models\Ce::getColumn('behavior_in_fire')->default }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Release of cadmium') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    {{ setting('ce_release_of_cadmium') }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Emission of radioactivity') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    {{ setting('ce_emission_of_radioactivity') }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #333;padding: 3px 2px;">{{ __('Durability') }}</td>
                <td style="border: 1px solid #333;padding: 3px 2px;font-weight:bold;">
                    @if($form->data->durability_group && is_array($form->data->durability_group))
                        @foreach($form->data->durability_group as $value)
                            {{ sprintf('Surface preparation %s, Preparation grade %s', $value['surface'], $value['prepration_grade']) }}
                            @if(!$loop->last)
                                ;
                            @endif
                        @endforeach
                    @endif


                </td>
            </tr>
        </table>
        <div style="margin-top:18px;">{{ __('10. The performance of the product identified in points 1 and 2 is in conformity with the declared performance in point 9.') }}</div>
        <div style="margin-top:18px;">{{ __('This declaration of performance is issued under the sole responsibility of the manufacturer identified in point 4.') }}</div>

        <div style="margin-top:18px;">{{ __('Signed for and on behalf of the manufacturer by:') }}</div>
        <div style="display:flex;align-items:center;flex-direction:column;margin-top:10px;">
            <div>
                @if($form->data->signature)
                    @php($row = setting('signature_group')[$form->data->signature])
                    {{ $row[0] }} - {{ $row[1] }}
                @endif
            </div>
            <div style="border-top: 1px dotted #333;width:200px;margin-top:5px;"></div>
            <div style="font-style:italic;margin-top:5px;">{{ __('Name and function') }}</div>
        </div>

        <div style="display:flex;justify-content: space-around;margin-top:10px;">
            <div style="display:flex;align-items:center;flex-direction:column;margin-top:10px;">
                <div style="@if($form->data->signature) margin-top:41px; @endif">{!! setting('ce_company_city') !!} - {{ now()->format('Y-m-d') }}</div>
                <div style="border-top: 1px dotted #333;width:200px;margin-top:5px;"></div>
                <div style="font-style:italic;margin-top:5px;">{{ __('Place and date of issue') }}</div>
            </div>
            <div style="display:flex;align-items:center;flex-direction:column;margin-top:10px;">
                @if($form->data->signature)
                    @php($row = setting('signature_group')[$form->data->signature])
                    <img src="{{ \App\Helpers\DigitalSignature::image(name: implode(' - ', $row), base64: true, width: 200) }}"/>
                @else
                    <span>&nbsp;</span>
                @endif
                <div style="border-top: 1px dotted #333;width:200px;margin-top:5px;"></div>
                <div style="font-style:italic;margin-top:5px;">{{ __('Signature') }}</div>
            </div>
        </div>
    </div>
</div>
