<div>
    <div class="items-center justify-between block p-4 bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0">
      <div class="w-full mb-1 text-black">
        <div class="my-2 md:my-4">
          <h1 class="m-0 text-xl font-semibold leading-7 text-gray-900 sm:text-2xl sm:leading-8">
            {{ __('Companies') }}
          </h1>
        </div>
        <div class="sm:flex">
          <div class="items-center hidden mb-3 sm:mb-0 sm:flex">
            <!-- <form class="lg:pr-3" action="#" method="GET">
              <label
                for="users-search"
                class="border-gray-200 border-solid cursor-default sr-only"
                >Search</label
              >
              <div class="relative mt-1 lg:w-64 xl:w-64">
                <input
                  type="text"
                  name="email"
                  id="users-search"
                  class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                  placeholder="Search for users"
                />
              </div>
            </form> -->
            <!-- <div class="flex pl-0 mt-3 border-0 border-gray-100 border-solid sm:mt-0 sm:border-r-0 sm:border-l sm:border-gray-100 sm:pl-2">
              <a
                href="#"
                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:bg-gray-100 hover:text-gray-900"
              >
                <svg
                  class="block w-6 h-6 align-middle"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                    clip-rule="evenodd"
                    class=""
                  ></path>
                </svg>
              </a>
              <a
                href="#"
                class="inline-flex justify-center p-1 ml-1 mr-0 text-gray-500 rounded cursor-pointer hover:bg-gray-100 hover:text-gray-900"
              >
                <svg
                  class="block w-6 h-6 align-middle"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"
                    class=""
                  ></path>
                </svg>
              </a>
              <a
                href="#"
                class="inline-flex justify-center p-1 ml-1 mr-0 text-gray-500 rounded cursor-pointer hover:bg-gray-100 hover:text-gray-900"
              >
                <svg
                  class="block w-6 h-6 align-middle"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd"
                    class=""
                  ></path>
                </svg>
              </a>
              <a
                href="#"
                class="inline-flex justify-center p-1 ml-1 mr-0 text-gray-500 rounded cursor-pointer hover:bg-gray-100 hover:text-gray-900"
              >
                <svg
                  class="block w-6 h-6 align-middle"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
                    class=""
                  ></path>
                </svg>
              </a>
            </div> -->
          </div>
          <div class="flex items-center ml-auto">
            <x-button.link href="{{ route('companies.create') }}" class="inline-flex items-center justify-center">
                <x-icon.plus class="mr-2 -ml-1 align-middle" />
                {{ __('Add company') }}
            </x-button.link>
            <!-- <a
              href="#"
              class="inline-flex items-center justify-center w-1/2 px-3 py-2 ml-3 mr-0 text-sm font-medium leading-5 text-center text-gray-900 border border-gray-300 border-solid rounded-lg cursor-pointer sm:mr-0 sm:ml-3 sm:w-auto hover:bg-gray-100"
            >
              <svg
                class="block w-6 h-6 mr-2 -ml-1 align-middle"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                  clip-rule="evenodd"
                  class=""
                ></path>
              </svg>
              Export
            </a> -->
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <div class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable>{{ __('Name') }}</x-table.heading>
                        <x-table.heading />
                    </x-slot>
                    <x-slot name="body">
                        @foreach($companies as $company)
                            <x-table.row>
                                <x-table.cell>{{ $company->name }}</x-table.cell>

                                <x-table.cell class="text-right">
                                    @if(auth()->user()->currentCompany()->is($company))
                                        <x-button.link
                                            href="{{ route('switch-company', $company) }}"
                                            class="text-gray-600 bg-cyan-600 hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.switch class="w-4 h-4 text-white-600" />
                                        </x-button.link>
                                    @else
                                        <x-button.link
                                            href="{{ route('switch-company', $company) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.switch class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
                                    @endif
                                    @if(auth()->user()->isAdmin())
                                        <x-button.link
                                            href="{{ route('companies.edit', $company) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.pencil class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
                                    @endif
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</div>
