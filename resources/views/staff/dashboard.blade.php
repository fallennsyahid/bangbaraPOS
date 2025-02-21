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
                <main class="bg-prime">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6">
                        <h1 class="text-2xl text-zinc-950 font-semibold">Dashboard</h1>
                        <x-staff.waButton></x-staff.waButton>
                    </div>

                    <!-- Content -->
                    <div class="mt-2">
                        <!-- State cards -->
                        <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-3">
                            <!-- Income card -->
                            <div class="bg-red-600 text-center text-white rounded-xl shadow-lg p-6 w-80 mx-auto">
                                <h6 class="text-lg font-medium">Total Income</h6>
                                <p class="text-3xl font-bold">Rp {{ number_format($totalIncome) }}</p>
                            </div>


                            <!-- Selling card -->
                            <div class="bg-red-600 text-center text-white rounded-xl shadow-lg p-6 w-80 mx-auto">
                                <h6 class="text-lg font-medium">Total Selling</h6>
                                <p class="text-3xl font-bold">{{ $histories }}</p>
                            </div>

                            <!-- Orders card -->
                            <div class="bg-red-600 text-center text-white rounded-xl shadow-lg p-6 w-80 mx-auto">
                                <h6 class="text-lg font-medium">Total Orders</h6>
                                <p class="text-3xl font-bold" id="totalOrders">{{ $total_orders }}</p>
                            </div>

                            <!-- Completed card -->
                            <div class="bg-red-600 text-center text-white rounded-xl shadow-lg p-6 w-80 mx-auto">
                                <h6 class="text-lg font-medium">Total completed orders</h6>
                                <p class="text-3xl font-bold">{{ $total_orders_completed }}</p>
                            </div>

                            <!-- Cancelled card -->
                            <div class="bg-red-600 text-center text-white rounded-xl shadow-lg p-6 w-80 mx-auto">
                                <h6 class="text-lg font-medium">Total cancelled orders</h6>
                                <p class="text-3xl font-bold">{{ $total_orders_cancelled }}</p>
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

                        <div class="flex justify-center mt-4 py-4">
                            <select name="filter_year" id="filter_year"
                                class="bg-[#FFFFFF] text-zinc-950 py-4 px-11 rounded-md shadow-lg">
                                <option value="">All Time</option>
                                @foreach ($years as $y)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Charts -->
                        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <!-- Bar chart card -->
                            <div class="col-span-2 ml-8 bg-[#D3D3D3] rounded-md border border-bg-amber-300 shadow-xl"
                                x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-amber-300">
                                    <h4 class="text-lg font-semibold text-gray-900">Total
                                        Income
                                    </h4>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4 h-72">
                                    <canvas id="orderChart"></canvas>
                                </div>
                            </div>
                            {{-- Best seller chart --}}
                            <div class="col-span-1 bg-[#D3D3D3] rounded-md border border-white shadow-xl p-4">
                                <!-- Card header -->
                                <div class="border-b border-white pb-2 mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">Best Seller</h4>
                                </div>
                                <!-- Chart -->
                                <div class="relative h-72">
                                    <canvas id="bestSellerChart"></canvas>
                                </div>
                            </div>
                            {{-- Orders Method Chart --}}
                            <div class="flex justify-center mt-4 py-4">
                                <select name="filter_year" id="filter_year"
                                    class="bg-[#FFFFFF] text-zinc-950 py-4 px-11 rounded-md shadow-lg">
                                    @foreach ($years as $y)
                                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                            {{ $y }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-3 bg-[#D3D3D3] rounded-md border border-white shadow-xl p-4 mt-8">
                                <!-- Card header -->
                                <div class="border-b border-white pb-2 mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">Orders Method</h4>
                                </div>
                                <!-- Chart -->
                                <div class="relative h-72">
                                    <canvas id="ordersLineChart"></canvas>
                                </div>
                            </div>
                        </div>
                </main>
                {{-- Chart Order --}}
                <script>
                    const ctx = document.getElementById('orderChart').getContext('2d');


                    let orderChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                'October', 'November', 'December'
                            ],

                            datasets: [{
                                label: 'Total Income',
                                data: @json($totals),
                                backgroundColor: '#D3A200',
                                borderColor: '#D3A200',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    ticks: {
                                        callback: function(value) {
                                            return value.toLocaleString(); // Format angka dengan pemisah ribuan
                                        }
                                    }
                                }
                            }
                        }
                    });


                    // Event Listener untuk Dropdown Tahun
                    document.getElementById('filter_year').addEventListener('change', function() {
                        const selectedYear = this.value;
                        fetch(`/chart-data?year=${selectedYear}`)
                            .then(response => response.json())
                            .then(data => {
                                const allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                                    'September',
                                    'October', 'November', 'December'
                                ];

                                // Objek Menyimpan total perbulan (default 0)
                                let monthTotals = {};
                                allMonths.forEach(month => {
                                    monthTotals[month] = 0
                                });

                                // Masukkan data ke API ke dalam objek
                                data.months.forEach((month, index) => {
                                    monthTotals[month] = data.totals[index];
                                });

                                // Update data chart
                                orderChart.data.labels = allMonths;
                                orderChart.data.datasets[0].data = data.totals;
                                orderChart.update();
                            })
                            .catch(error => console.error('Error:', error)); // <- titik koma hanya di akhir catch
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
    <script>
        function fetchOrders() {
            fetch('/get-total-orders-today')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalOrders').innerText = data.total_orders;
                })
                .catch(error => console.error('Error:', error));
        }

        setInterval(fetchOrders, 5000);
    </script>
    {{-- best seller data --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctxBestSeller = document.getElementById('bestSellerChart').getContext('2d');

            fetch('/best-seller-chart')
                .then(response => response.json())
                .then(data => {
                    const bestSellerChart = new Chart(ctxBestSeller, {
                        type: 'doughnut',
                        data: {
                            labels: data.products, // Nama produk
                            datasets: [{
                                label: 'Total Sold',
                                data: data.totals, // Jumlah produk terjual
                                backgroundColor: [
                                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                                ],
                                borderColor: '#FFFFFF',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    {{-- Method Orders data --}}
    <script>
        // Inisialisasi label bulan secara statis
        const staticMonths = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Inisialisasi chart line dengan data awal yang dikirim dari controller
        const ctxLine = document.getElementById('ordersLineChart').getContext('2d');
        let ordersLineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: staticMonths,
                datasets: [{
                        label: 'Tunai',
                        data: @json($tunaiData),
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                    {
                        label: 'nonTunai',
                        data: @json($nonTunaiData),
                        borderColor: '#FF6384',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.4,
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Event listener untuk dropdown tahun
        document.getElementById('filter_year').addEventListener('change', function() {
            const selectedYear = this.value;
            fetch(`/orders-stats?year=${selectedYear}`)
                .then(response => response.json())
                .then(data => {
                    // Update data chart line
                    ordersLineChart.data.datasets[0].data = data.tunai;
                    ordersLineChart.data.datasets[1].data = data.non_tunai;
                    ordersLineChart.update();
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>
