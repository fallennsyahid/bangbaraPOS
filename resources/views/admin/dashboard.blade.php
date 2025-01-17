<x-admin.header></x-admin.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-admin.sidebar></x-admin.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-admin.navbar></x-admin.navbar>

                <!-- Main content -->
                <main class="dark:bg-zinc-950">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-slate-950">
                        <h1 class="text-2xl font-semibold">Dashboard</h1>
                        <x-admin.waButton></x-admin.waButton>
                    </div>

                    <!-- Content -->
                    <div class="mt-2">
                        <!-- State cards -->
                        <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
                            <!-- Value card -->
                            <div class="flex items-center justify-between p-4 bg-red-700 dark:bg-amber-300 rounded-md">
                                <div>
                                    <h6 class="text-xs font-medium leading-none tracking-wider text-white uppercase">
                                        Total Pemasukkan
                                    </h6>
                                    <span class="text-xl font-semibold text-white">Rp.700.000</span>
                                    <span
                                        class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                                        +4.4%
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <svg class="w-12 h-12 text-gray-200" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <!-- Users card -->
                            <div class="flex items-center justify-between p-4 bg-red-700 dark:bg-amber-300 rounded-md">
                                <div>
                                    <h6 class="text-xs font-medium leading-none tracking-wider text-white uppercase">
                                        Total Penjualan
                                    </h6>
                                    <span class="text-xl font-semibold text-white">50,021</span>
                                    <span
                                        class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                                        +2.6%
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <img src="{{ asset('asset-admin/public/img/icon/order.png') }}"
                                            fill-current="none" class="w-12 h-12 text-white" alt="">
                                    </span>
                                </div>
                            </div>

                            <!-- Orders card -->
                            <div class="flex items-center justify-between p-4 bg-red-700 dark:bg-amber-300 rounded-md">
                                <div>
                                    <h6 <h6
                                        class="text-xs font-medium leading-none tracking-wider text-white uppercase">
                                        Total Pesanan
                                    </h6>
                                    <span class="text-xl font-semibold text-white">{{ $total_orders }} orders</span>
                                </div>
                                <div>
                                    <span>
                                        <img src="{{ asset('asset-admin/public/img/icon/order_list.png') }}"
                                            fill-current="none" class="w-12 h-12 text-white" alt="">
                                    </span>
                                </div>
                            </div>

                            <!-- Product card -->
                            <div class="flex items-center justify-between p-4 bg-red-700 dark:bg-amber-300 rounded-md">
                                <div>
                                    <h6 <h6
                                        class="text-xs font-medium leading-none tracking-wider text-white uppercase">
                                        Total Product
                                    </h6>
                                    <span class="text-xl font-semibold text-white">{{ $products }} products</span>

                                </div>
                                <div>
                                    <span>
                                        <img src="{{ asset('asset-admin/public/img/icon/product.png') }}"
                                            fill-current="none" class="w-12 h-12 text-white" alt="">
                                    </span>
                                </div>
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
                            <div class="col-span-2 bg-white rounded-md border border-bg-amber-300 dark:bg-zinc-950"
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

                            <!-- Doughnut chart card -->
                            {{-- <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Doughnut Chart</h4>
                                    <div class="flex items-center">
                                        <button class="relative focus:outline-none" x-cloak
                                            @click="isOn = !isOn; $parent.updateDoughnutChart(isOn)">
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
                                    <canvas id="doughnutChart"></canvas>
                                </div>
                            </div> --}}
                        </div>

                        <!-- Two grid columns -->
                        {{-- <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <!-- Active users chart -->
                            <div class="col-span-1 bg-white rounded-md dark:bg-darker">
                                <!-- Card header -->
                                <div class="p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Active users right
                                        now</h4>
                                </div>
                                <p class="p-4">
                                    <span class="text-2xl font-medium text-gray-500 dark:text-light"
                                        id="usersCount">0</span>
                                    <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
                                </p>
                                <!-- Chart -->
                                <div class="relative p-4">
                                    <canvas id="activeUsersChart"></canvas>
                                </div>
                            </div>

                            <!-- Line chart card -->
                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
                                    <div class="flex items-center">
                                        <button class="relative focus:outline-none" x-cloak
                                            @click="isOn = !isOn; $parent.updateLineChart()">
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
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div> --}}
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
                                backgroundColor: '#dc2626',
                                borderColor: '#dc2626',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: true, // Agar bisa diatur lebar-tinggi manual
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
