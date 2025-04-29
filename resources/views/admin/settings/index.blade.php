<x-admin.header></x-admin.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-prime dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-admin.sidebar></x-admin.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-admin.navbar></x-admin.navbar>

                <main class="bg-prime p-6">
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4">
                        <h1 class="text-2xl font-semibold text-zinc-950">Settings</h1>
                    </div>
                    <h2 class="mb-4 text-center">
                        <a href="javascript:history.back()" class="text-amber-400 hover:underline">Back </a>/
                        <a href="/admin/dashboard" class="hover:underline text-zinc-950">Home</a>
                    </h2>
                    {{-- Printer Settings --}}
                    <h1 class="text-xl text-center font-semibold text-zinc-950 mb-4">Printer Settings</h1>
                    <div class="min-h-full mt-4 flex items-center justify-center bg-prime">
                        <div class=" w-full mx-auto bg-white p-6 rounded-lg shadow-lg">
                            <div class="flex flex-col p-3 items-center">
                                <p><strong>Current:</strong> {{ $user->printer_name ?? 'Not Set yet' }}</p>
                                <form action="{{ route('admin.setPrinter') }}" method="POST"
                                    class="flex flex-col items-center w-full">
                                    @csrf
                                    <input type="text" placeholder="Set Printer Name" name="printer_name"
                                        id="printer_name"
                                        class="p-2 rounded-xl font-medium w-full border-2 border-yellow-300 text-center focus:outline-none focus:border-2 focus:border-yellow-400 focus:shadow-lg">
                                    <label for="printer-update"
                                        class="flex items-center justify-center gap-2 bg-yellow-400 py-2 px-4 mt-4 max-w-40 rounded-md text-white font-semibold cursor-pointer hover:bg-yellow-500 group">
                                        <svg fill="#000000" width="30px" height="30px" viewBox="0 0 24 24"
                                            id="update-alt" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg"
                                            class="icon flat-line group-hover:rotate-180 transition duration-300">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path id="primary" d="M5.07,8A8,8,0,0,1,20,12"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </path>
                                                <path id="primary-2" data-name="primary" d="M18.93,16A8,8,0,0,1,4,12"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </path>
                                                <polyline id="primary-3" data-name="primary" points="5 3 5 8 10 8"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </polyline>
                                                <polyline id="primary-4" data-name="primary" points="19 21 19 16 14 16"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </polyline>
                                            </g>
                                        </svg>
                                        Update
                                    </label>
                                    <input type="submit" value="Update" class="hidden" id="printer-update">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Location -->
                    <h1 class="text-xl text-center font-semibold text-zinc-950 mb-4">Location Settings</h1>
                    <div class="min-h-full mt-4 flex items-center justify-center bg-prime">
                        <div class=" w-full mx-auto bg-white p-6 rounded-lg shadow-lg">
                            <div class="flex flex-col p-3 items-center space-y-6">

                                <form action="{{ route('admin.setLocation') }}" method="POST"
                                    class="flex flex-col items-center w-full">
                                    @csrf
                                    <!-- Set latitude -->
                                    <label for="latitude">Set latitude</label>
                                    <input type="text" placeholder="Set Latitude" name="latitude" id="latitude"
                                        value="{{ $location->latitude ?? '' }}"
                                        class="p-2 rounded-xl font-medium w-full border-2 border-yellow-300 text-center focus:outline-none focus:border-2 focus:border-yellow-400 focus:shadow-lg">

                                    <!-- Set latitude -->
                                    <label for="longitude">Set longitude</label>
                                    <input type="text" placeholder="Set Longitude" name="longitude" id="longitude"
                                        value="{{ $location->longitude ?? '' }}"
                                        class="p-2 rounded-xl font-medium w-full border-2 border-yellow-300 text-center focus:outline-none focus:border-2 focus:border-yellow-400 focus:shadow-lg">


                                    <label for="location-update"
                                        class="flex items-center justify-center gap-2 bg-yellow-400 py-2 px-4 mt-4 max-w-40 rounded-md text-white font-semibold cursor-pointer hover:bg-yellow-500 group">
                                        <svg fill="#000000" width="30px" height="30px" viewBox="0 0 24 24"
                                            id="update-alt" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg"
                                            class="icon flat-line group-hover:rotate-180 transition duration-300">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path id="primary" d="M5.07,8A8,8,0,0,1,20,12"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </path>
                                                <path id="primary-2" data-name="primary" d="M18.93,16A8,8,0,0,1,4,12"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </path>
                                                <polyline id="primary-3" data-name="primary" points="5 3 5 8 10 8"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </polyline>
                                                <polyline id="primary-4" data-name="primary"
                                                    points="19 21 19 16 14 16"
                                                    style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </polyline>
                                            </g>
                                        </svg>
                                        Update
                                    </label>
                                    <input type="submit" value="Update" class="hidden" id="location-update">
                                </form>
                            </div>
                        </div>
                    </div>


                    {{-- Template Excel --}}
                    <h1 class="text-xl text-center font-semibold text-zinc-950 mt-4 mb-2">Download Excel Format</h1>
                    <div class="min-h-full mt-4 flex items-center justify-center bg-prime">
                        <div class=" w-full mx-auto bg-white p-4 rounded-lg shadow-lg">
                            <h6 class="text-red-500 pb-4 text-center">*You must download this format to import data
                                product*
                            </h6>
                            <div class="flex items-center justify-center">
                                <a href="{{ asset('asset-admin/files/format-import.xlsx') }}" download
                                    class="flex items-center gap-2 bg-green-600 px-4 py-2 rounded-md text-white font-semibold hover:bg-green-700">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="currenColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M12.5535 16.5061C12.4114 16.6615 12.2106 16.75 12 16.75C11.7894 16.75 11.5886 16.6615 11.4465 16.5061L7.44648 12.1311C7.16698 11.8254 7.18822 11.351 7.49392 11.0715C7.79963 10.792 8.27402 10.8132 8.55352 11.1189L11.25 14.0682V3C11.25 2.58579 11.5858 2.25 12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V14.0682L15.4465 11.1189C15.726 10.8132 16.2004 10.792 16.5061 11.0715C16.8118 11.351 16.833 11.8254 16.5535 12.1311L12.5535 16.5061Z"
                                                fill="#ffffff"></path>
                                            <path
                                                d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z"
                                                fill="#ffffff"></path>
                                        </g>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>

                </main>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <x-admin.js></x-admin.js>
</body>

</html>
