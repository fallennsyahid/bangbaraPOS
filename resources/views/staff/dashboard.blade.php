<x-staff.header></x-admin.header>

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
                    <main class="bg-prime">
                        <!-- Content header -->
                        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6">
                            <h1 class="text-2xl text-zinc-950 font-semibold">Dashboard</h1>
                            <x-admin.waButton></x-admin.waButton>
                        </div>

                        <!-- Content -->
                        <div class="mt-2">
                            <!-- State cards -->
                            <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-3">
                                <!-- Income card -->
                                <div class="bg-red-600 text-center text-black rounded-xl shadow-lg p-6 w-80 mx-auto">
                                    <h6 class="text-lg font-medium">Total Income (Today)</h6>
                                    <p class="text-2xl font-bold">Rp {{ number_format($totalIncome) }}</p>
                                </div>


                                <!-- Selling card -->
                                <div class="bg-red-600 text-center text-black rounded-xl shadow-lg p-6 w-80 mx-auto">
                                    <h6 class="text-lg font-medium">Total Selling (Today)</h6>
                                    <p class="text-2xl font-bold">{{ $histories }}</p>
                                </div>

                                <!-- Orders card -->
                                <div class="bg-red-600 text-center text-black rounded-xl shadow-lg p-6 w-80 mx-auto">
                                    <h6 class="text-lg font-medium">Total Orders (Today)</h6>
                                    <p class="text-2xl font-bold">{{ $total_orders }}</p>
                                </div>

                                <!-- Completed card -->
                                <div class="bg-red-600 text-center text-black rounded-xl shadow-lg p-6 w-80 mx-auto">
                                    <h6 class="text-lg font-medium">Total completed orders (Today)</h6>
                                    <p class="text-2xl font-bold">{{ $total_orders_completed }}</p>
                                </div>
                                <!-- Cancelled card -->
                                <div class="bg-red-600 text-center text-black rounded-xl shadow-lg p-6 w-80 mx-auto">
                                    <h6 class="text-lg font-medium">Total cancelled orders (Today)</h6>
                                    <p class="text-2xl font-bold">{{ $total_orders_cancelled }}</p>
                                </div>
                                <!-- Tickets card -->
                                {{-- <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h6
                                        class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                        Tickets
                                    </h6>
                                    <span class="text-xl font-semibold">20,516</span>
                                    <span
                                        class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                                        +3.1%
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </span>
                                </div>
                            </div> --}}
                            </div>

                            <!-- Charts -->
                            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                                <!-- Bar chart card -->
                                <div class="col-span-2 bg-[#D3D3D3] rounded-md border border-bg-amber-300 shadow-xl"
                                    x-data="{ isOn: false }">
                                    <!-- Card header -->
                                    <div class="flex items-center justify-between p-4 border-b dark:border-amber-300">
                                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Total
                                            Penjualan
                                        </h4>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-gray-500 dark:text-light">Last year</span>
                                            <button class="relative focus:outline-none" x-cloak
                                                @click="isOn = !isOn; $parent.updateBarChart(isOn)">
                                                <div
                                                    class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                                                </div>
                                                <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                                    :class="{
                                                        'translate-x-0  bg-white dark:bg-primary-100': !
                                                            isOn,
                                                        'translate-x-6 bg-primary-light dark:bg-primary': isOn
                                                    }">
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Chart -->
                                    <div class="relative p-4 h-72">
                                        <canvas id="orderChart"></canvas>
                                    </div>
                                </div>
                            </div>
                    </main>
                    {{-- Chart Order --}}
                    <script>
                        const ctx = document.getElementById('orderChart');

                        const months = @json($months);
                        const totals = @json($totals);

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                    'October', 'November', 'December'
                                ],
                                datasets: [{
                                    label: '# of Votes',
                                    data: totals,
                                    backgroundColor: '#D3A200',
                                    borderColor: '#D3A200',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                maintainAspectRatio: false, // Agar bisa diatur lebar-tinggi manual
                                scales: {
                                    y: {
                                        ticks: {
                                            callback: function(value) {
                                                return value; // Menampilkan angka biasa di sumbu y
                                            }
                                        },
                                    }
                                }
                            }
                        });
                    </script>


                    <!-- Main footer -->
                    <footer
                        class="flex items-center justify-between p-4 bg-white dark:bg-zinc-900 dark:border-primary-darker">
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

        <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
        <x-admin.js></x-admin.js>
    </body>

    </html>
