@props([
    'heading',
    'buttons',
    'search',
])

<div class="items-center justify-between block p-4 bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0">
    <div class="w-full mb-1 text-black">
        <div class="my-2 md:my-4">
            <h1 class="flex items-center m-0 text-xl font-semibold leading-7 text-gray-900 sm:text-2xl sm:leading-8">
                {{ $heading}}
            </h1>

        </div>
        <div class="sm:flex">
            <div class="items-center hidden mb-3 sm:mb-0 sm:flex">
                @if(isset($search))
                    {{ $search }}
                @endif
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
            @if (isset($buttons))
                <div class="flex items-center ml-auto space-x-4">
                    {{ $buttons }}
                </div>
            @endif
        </div>
    </div>
</div>
