<div>
    <x-form-header backlink="{{ route('supplier.index') }}">
        <x-slot name="title">{{ __('Edit Supplier') }}</x-slot>
    </x-form-header>
    <form
        class="px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="update"
    >
        @include('livewire.supplier.form')
        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary type="submit" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button.primary>
            </div>
        </div>
    </form>

    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <div class="flex justify-between mx-0 mt-0 mb-4">
                <h3 class=" text-xl font-bold leading-7">
                    {{ __('Supplier assessments') }}
                </h3>
                <div>
                    <x-button.primary wire:click="toggleAssessmentFormOpen">
                        {{ __('New assessment') }}
                    </x-button.primary>
                </div>
            </div>

            <ul role="list" class="space-y-6">
                @forelse($supplier->reports as $report)
                    <li class="relative flex gap-x-4">
                        @unless($loop->last)
                            <div class="absolute top-0 left-0 flex justify-center w-6 -bottom-6">
                                <div class="w-px bg-gray-200"></div>
                            </div>
                        @endif
                        <div class="relative flex items-center justify-center flex-none w-6 h-6 bg-white">
                            <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                        </div>
                        <div class="flex items-center flex-auto py-0.5 text-sm leading-5 text-gray-500">
                            <span class="mr-2 font-medium text-gray-900">{{ $report->user->name }}</span>
                            {{ __('created this assement.') }}

                            @if($report->current_file_id)
                                @php($file = App\Models\File::find($report->current_file_id))
                                <div class="ml-2">
                                    <x-file-with-modal :file="$file" svg_location="left" icon_class="w-4 h-4" />
                                </div>
                            @endif
                        </div>
                        <div class="flex-none py-0.5 text-sm leading-5 text-gray-500">
                            {{ $report->data['assessment_date'] }}
                        </div>
                    </li>
                @empty
                <li class="text-gray-500">
                    {{ __('No assessments yet.') }}
                </li>
                @endforelse
            </ul>

            <!-- New assessment form -->
            @if($assessmentFormOpen)
                <x-modal id="assessment-form" maxWidth="lg">

                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="mx-0 mt-0 mb-2 font-bold leading-7 text-md">
                                {{ __('New assessment') }}
                            </h3>
                            <div class="relative block max-w-md">
                                <div class="flex mb-2 item-center">
                                    <x-label for="new_assessment_date" :value="__('Select date for supplier assessment')" class="!mb-0" />
                                </div>
                                <div>
                                    <x-input.date wire:model="form.new_assessment_date" id="new_assessment_date" class="w-full" />
                                </div>
                                <div class="flex mt-4 mb-2 item-center">
                                    <x-label for="new_assessment_file" :value="__('Upload of supplier assessment')" class="!mb-0" />
                                </div>
                                <div>
                                    <x-input.filepond wire:model="form.new_assessment_file" id="new_assessment_file" class="w-full" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
                        <x-button.primary wire:click="createReport">
                            {{ __('Create') }}
                        </x-button.primary>
                        <x-button.secondary
                            wire:click="toggleAssessmentFormOpen"
                        >{{ __('Cancel') }}</x-button.secondary>
                    </div>
                </x-modal>
            @endif
        </div>
    </div>
</div>
