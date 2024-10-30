<div>
    <div class="grid grid-cols-1 gap-6 mx-6 my-5 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
        @foreach([[], [], [], []] as $dummy)
            <div class="grid grid-cols-2 rounded-lg bg-white p-8">
                <div>
                    <div class="flex flex-col h-full justify-between">
                        <div>
                            <p class="text-sm text-gray-500">&nbsp;</p>
                            <h3 class="text-lg font-semibold text-gray-900">&nbsp;</h3>
                        </div>
                        <div>
                            <!-- <div>
                                <span class="text-sm ml-2">
                                    Scope:
                                </span>
                                <span class="text-sm font-semibold">
                                    20%
                                </span>
                            </div> -->
                            <div>
                                <span class="inline-block h-2 w-2 "></span>
                                <span class="text-sm">
                                    &nbsp;
                                </span>
                                <span class="text-sm font-semibold">
                                    &nbsp;
                                </span>
                                <span class="text-xs text-gray-500">
                                    &nbsp;
                                </span>
                            </div>
                            <div>
                                <span class="inline-block h-2 w-2"></span>
                                <span class="text-sm">
                                    &nbsp;
                                </span>
                                <span class="text-sm font-semibold">
                                    &nbsp;
                                </span>
                                <span class="text-xs text-gray-500">
                                    &nbsp;
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
