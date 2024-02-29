<div class="flex justify-center mt-8">
    <div style="width: 750px;font-family:Arial;font-size:9pt;border: 1px solid #333;line-height:1;zoom:0.5;padding: 50px 25px;">
        <h2 style="font-size: 14pt;font-weight:bold;text-align:center;margin-bottom:5px;">{{ __('Declaration of performance') }}</h2>
        <div style="font-size: 10pt;font-style:italic;text-align:center;">{{ __('CPR 305/2011/EU') }}</div>
        <div style="margin-top:25px;">1. Identification of the product type:</div>
        <div style="font-weight:bold;text-align:center;">Structural metallic products and ancillaries</div>
        <div style="margin-top:15px;">2. Construction product:</div>
        <div style="font-weight:bold;text-align:center;">According to
        <x-tooltip-word :tooltip="__('Project')">
            @if($form->project_id)
                @php($project = App\Models\Project::find($form->project_id))
                @if($project)
                    {{ $project->data['number'] }} -  {{ $project->data['name'] }}
                @endif
            @endif
        </x-tooltip-word>
        </div>
    </div>


</div>
