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
                        <h1 class="text-xs md:text-lg space-x-2 text-zinc-950 font-serif">"Selamat datang di Dashboard
                            Staff!
                            Semoga harimu
                            produktif dan penuh energi, {{ Auth::user()->name }} 👋!"</h1>
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



                        <!-- Charts -->
                        <div class="grid grid-cols-1 gap-4 p-4 lg:grid-cols-2 lg:gap-4 h-100">
                            <!-- Bar chart card (Total Income) -->
                            <div class="bg-[#D3D3D3] rounded-md border border-gray-400 shadow-xl p-4">
                                <!-- Filter Orders Method -->
                                <div class="hidden flex flex-col sm:flex-row gap-4 mb-4">
                                    <input type="date" id="filter_date"
                                        class="bg-white text-gray-900 py-2 px-4 rounded-md shadow-lg"
                                        value="{{ date('Y-m-d') }}">
                                    <button id="btn_filter" class="bg-red-700 text-white py-2 px-4 rounded-md">
                                        Filter
                                    </button>
                                </div>

                                <!-- Card header -->
                                <div class="border-b border-white pb-2 mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">Orders Method (Today)</h4>
                                </div>

                                <!-- Chart -->
                                <div class="relative h-60">
                                    <canvas id="hourlyMethodChart"></canvas>
                                </div>
                            </div>

                            <!-- Best Seller Chart -->
                            <div class="bg-[#D3D3D3] rounded-md border border-gray-400 shadow-xl p-4">
                                <!-- Card header -->
                                <div class="border-b border-gray-400 pb-2 mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">Best Seller (Today)</h4>
                                </div>

                                <!-- Chart -->
                                <div class="relative h-60">
                                    <canvas id="bestSellerChart"></canvas>
                                    <div id="noDataMessage"
                                        class="hidden flex items-center justify-center h-full text-gray-700 font-medium">
                                        Tidak ada produk yang dijual di periode ini.
                                    </div>
                                </div>
                            </div>
                        </div>





                </main>
                {{-- Chart Order --}}

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
            const noDataMessage = document.getElementById('noDataMessage');
            let bestSellerChart; // Simpan instance chart agar bisa diperbarui

            function fetchData() {
                let url = `/best-seller-today`; // Fetch langsung dari route ini

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Jika sudah ada chart sebelumnya, hancurkan terlebih dahulu
                        if (bestSellerChart) {
                            bestSellerChart.destroy();
                        }

                        // Jika tidak ada produk, tampilkan pesan
                        if (!data.products || data.products.length === 0) {
                            document.getElementById('bestSellerChart').classList.add('hidden');
                            noDataMessage.classList.remove('hidden');
                        } else {
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
                        document.getElementById('bestSellerChart').classList.add('hidden');
                        noDataMessage.textContent = 'Terjadi kesalahan saat mengambil data.';
                        noDataMessage.classList.remove('hidden');
                    });
            }

            // Fetch data langsung dari `/best-seller-today`
            fetchData();
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
