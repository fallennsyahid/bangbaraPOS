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
                        <div class="grid grid-cols-1 gap-4 p-4 lg:grid-cols-3 lg:gap-8">
                            <!-- Bar chart card (Total Income) -->
                            <div class="bg-[#D3D3D3] rounded-md border border-gray-400 shadow-xl order-1 lg:col-span-2">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b border-gray-400">
                                    <h4 class="text-lg font-semibold text-gray-900">Total Income</h4>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4 h-72">
                                    <canvas id="orderChart"></canvas>
                                </div>
                            </div>

                            <!-- Best Seller Chart -->
                            <div class="bg-[#D3D3D3] rounded-md border border-gray-400 shadow-xl order-2 lg:col-span-1">
                                <!-- Filter di luar card (di atas border) -->
                                <div class="p-4">
                                    <div class="mb-4 flex flex-col gap-4">
                                        <div class="flex flex-col">
                                            <label for="start_date" class="text-gray-700 text-sm">Dari Tanggal</label>
                                            <input type="date" id="start_date"
                                                class="text-zinc-950 mt-1 p-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="end_date" class="text-gray-700 text-sm">Sampai Tanggal</label>
                                            <input type="date" id="end_date"
                                                class="text-zinc-950 mt-1 p-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <button id="filterButton"
                                            class="px-4 py-2 bg-red-700 text-white rounded hover:bg-red-600 transition mt-2 md:mt-0">
                                            Filter
                                        </button>
                                    </div>

                                    <!-- Card header -->
                                    <div class="border-b border-gray-400 pb-2 mb-4">
                                        <h4 class="text-lg font-semibold text-gray-900">Best Seller</h4>
                                    </div>

                                    <!-- Chart -->
                                    <div class="relative h-72">
                                        <canvas id="bestSellerChart"></canvas>
                                        <div id="chartContainer" class="relative h-72">
                                            <canvas id="bestSellerChart"></canvas>
                                            <!-- Pesan error akan dimunculkan di sini bila data kosong -->
                                            <div id="noDataMessage"
                                                class="hidden flex items-center justify-center h-full text-gray-700 font-medium">
                                                Tidak ada produk yang dijual di periode ini.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter & Orders Method Chart -->
                            <div
                                class="bg-[#D3D3D3] rounded-md border border-gray-400 shadow-xl order-3 p-4 lg:col-span-3">
                                <!-- Filter Orders Method -->
                                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                                    <input type="date" id="filter_date"
                                        class="bg-white text-gray-900 py-2 px-4 rounded-md shadow-lg"
                                        value="{{ date('Y-m-d') }}">
                                    <button id="btn_filter" class="bg-red-700 text-white py-2 px-4 rounded-md">
                                        Filter
                                    </button>
                                </div>

                                <!-- Card header -->
                                <div class="border-b border-white pb-2 mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">Orders Method</h4>
                                </div>

                                <!-- Chart -->
                                <div class="relative h-72">
                                    <canvas id="hourlyMethodChart"></canvas>
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
                            responsive: true,
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
            fetch('/get-total-orders')
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
            const chartContainer = document.getElementById('chartContainer');
            const noDataMessage = document.getElementById('noDataMessage');
            let bestSellerChart; // Simpan instance chart agar bisa diperbarui

            function fetchData(startDate = '', endDate = '') {
                let url = `/best-seller-chart-filter?start_date=${startDate}&end_date=${endDate}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Jika sudah ada chart sebelumnya, hancurkan terlebih dahulu
                        if (bestSellerChart) {
                            bestSellerChart.destroy();
                        }

                        // Jika tidak ada produk, tampilkan pesan
                        if (!data.products || data.products.length === 0) {
                            // Sembunyikan canvas chart dan tampilkan pesan
                            document.getElementById('bestSellerChart').classList.add('hidden');
                            noDataMessage.classList.remove('hidden');
                        } else {
                            // Jika ada data, pastikan canvas ditampilkan dan pesan disembunyikan
                            document.getElementById('bestSellerChart').classList.remove('hidden');
                            noDataMessage.classList.add('hidden');

                            bestSellerChart = new Chart(ctxBestSeller, {
                                type: 'doughnut',
                                data: {
                                    labels: data.products,
                                    datasets: [{
                                        label: 'Total Sold',
                                        data: data.totals,
                                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56',
                                            '#4BC0C0', '#9966FF'
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
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Tampilkan pesan error jika perlu
                        document.getElementById('bestSellerChart').classList.add('hidden');
                        noDataMessage.textContent = 'Terjadi kesalahan saat mengambil data.';
                        noDataMessage.classList.remove('hidden');
                    });
            }

            // Fetch data pertama kali tanpa filter
            fetchData();

            // Event listener untuk tombol filter
            document.getElementById('filterButton').addEventListener('click', function() {
                const startDate = document.getElementById('start_date').value;
                const endDate = document.getElementById('end_date').value;
                fetchData(startDate, endDate);
            });
        });
    </script>

    {{-- Method Orders data --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Label statis untuk 24 jam
            const staticLabels = Array.from({
                length: 24
            }, (_, i) => (i < 10 ? '0' + i : i) + ':00');

            // Inisialisasi chart dengan dua dataset default (nilai 0)
            const ctxHourly = document.getElementById('hourlyMethodChart').getContext('2d');
            let hourlyChart = new Chart(ctxHourly, {
                type: 'line',
                data: {
                    labels: staticLabels,
                    datasets: [{
                            label: 'Tunai',
                            data: Array(24).fill(0),
                            backgroundColor: 'rgba(255, 206, 86, 0.2)', // kuning transparan
                            borderColor: 'rgba(255, 206, 86, 1)', // kuning solid
                            borderWidth: 1
                        },
                        {
                            label: 'nonTunai',
                            data: Array(24).fill(0),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // contoh warna biru kehijauan
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
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

            // Fungsi untuk fetch data dan update chart
            function updateHourlyChart() {
                const date = document.getElementById('filter_date').value;
                fetch(`/hourly-orders-stats?date=${date}`)
                    .then(response => response.json())
                    .then(result => {
                        hourlyChart.data.labels = result.labels;
                        hourlyChart.data.datasets[0].data = result.tunai;
                        hourlyChart.data.datasets[1].data = result.non_tunai;
                        hourlyChart.update();
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Event listener untuk tombol filter
            document.getElementById('btn_filter').addEventListener('click', function() {
                updateHourlyChart();
            });

            // Update chart saat halaman pertama kali dimuat
            updateHourlyChart();
        });
    </script>
</body>

</html>
