<x-staff.header></x-staff.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-staff.sidebar></x-staff.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-staff.navbar></x-staff.navbar>

                <!-- Main content -->
                <main class="bg-gray-100 p-6">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4">
                        <h1 class="text-2xl font-semibold text-zinc-950">Settings</h1>
                    </div>
                    <h2 class="mb-4 text-center">
                        <a href="javascript:history.back()" class="text-amber-400 hover:underline">Back </a>/
                        <a href="/staff/dashboard" class="hover:underline text-zinc-950">Home</a>
                    </h2>
                    <div class="min-h-screen mt-4 items-center justify-center bg-gray-100">
                        {{-- Printer Settings --}}
                        <h1 class="text-xl text-center font-semibold text-zinc-950 mb-4">Printer Settings</h1>
                        <div class="min-h-full mt-4 flex items-center justify-center bg-prime">
                            <div class=" w-full mx-auto bg-white p-6 rounded-lg shadow-lg">
                                <div class="flex flex-col items-center">
                                    <p class="pb-2"><strong>Current:</strong>
                                        {{ $user->printer_name ?? 'Not Set yet' }}</p>
                                    <form action="{{ route('staff.setPrinter') }}" method="POST"
                                        class="flex flex-col items-center w-full">
                                        @csrf
                                        <input type="text" placeholder="Set Printer Name" name="printer_name"
                                            id="printe_name"
                                            class="p-2 rounded-xl font-medium w-full border-2 border-yellow-300 text-center focus:outline-none focus:border-2 focus:border-yellow-400 focus:shadow-lg">
                                        <label for="printer-update"
                                            class="flex items-center justify-center gap-2 bg-yellow-400 py-2 px-4 mt-4 max-w-40 rounded-md text-white font-semibold cursor-pointer hover:bg-yellow-500 group">
                                            <svg fill="#000000" width="30px" height="30px" viewBox="0 0 24 24"
                                                class="icon flat-line group-hover:rotate-180 transition duration-300"
                                                id="update-alt" data-name="Flat Line"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path id="primary" d="M5.07,8A8,8,0,0,1,20,12"
                                                        style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                    </path>
                                                    <path id="primary-2" data-name="primary"
                                                        d="M18.93,16A8,8,0,0,1,4,12"
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
                                        <input type="submit" value="Update" class="hidden" id="printer-update">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>

                <!-- Main footer -->
                <footer
                    class="flex items-center justify-between p-2 bg-white dark:bg-zinc-900 dark:border-primary-darker">
                    <div>Bangbara &copy; 2025</div>
                    <div>
                        Made by
                        <a href="https://github.com/Kamona-WD" target="_blank"
                            class="text-blue-500 hover:underline">BangbaraPos</a>
                    </div>
                </footer>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <x-admin.js></x-admin.js>
</body>

</html>
