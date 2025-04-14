<!-- Navbar -->
<header class="relative bg-white dark:bg-[#000000]">
    <div class="flex items-center justify-between p-2">
        <!-- Mobile menu button -->
        <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
            class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
            <span class="sr-only">Open main menu</span>
            <span aria-hidden="true">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </span>
        </button>

        <!-- Clock and stats -->
        <div class="flex items-center space-x-4">
            <span id="real-time-clock"
                class="inline-block text-xl font-bold tracking-wider uppercase text-slate-950 dark:text-light">
            </span>
            <span> | </span>
            <h2 @php $store = \App\Models\Store::first(); @endphp
                class="{{ $store && $store->status == 1 ? 'text-green-500' : 'text-red-700' }} font-semibold">
                {{ $store && $store->status ? 'Open' : 'Close' }}
            </h2>
        </div>

        <!-- Mobile sub menu button -->
        <button @click="isMobileSubMenuOpen = !isMobileSubMenuOpen"
            class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
            <span class="sr-only">Open sub menu</span>
            <span aria-hidden="true">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
            </span>
        </button>

        <!-- Desktop Right buttons -->
        <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
            <!-- Toggle dark theme button -->
            <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                <div class="w-12 h-6 transition rounded-full outline-none bg-slate-400">
                </div>
                <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                    :class="{
                        'translate-x-0 -translate-y-px  bg-yellow-300 text-white': !
                            isDark,
                        'translate-x-6 text-primary-100 bg-red-700': isDark
                    }">
                    <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
            </button>

            <!-- Notification button -->
            <div id="notif-navbar" class="z-10" x-data="notificationComponent()" x-init="fetchNotifications();
            setInterval(() => fetchNotifications(), 5000)">
                <button @click="open = !open"
                    class="relative p-2 transition-colors duration-200 rounded-full text-white bg-yellow-300 dark:bg-red-700 hover:bg-red-700 dark:hover:text-light dark:hover:bg-amber-300">
                    <span class="sr-only">Open Notification panel</span>
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>

                    <!-- Badge Notifikasi -->
                    <span x-show="notifCount > 0" x-text="notifCount"
                        class="absolute top-0 right-0 -mt-1 -mr-1 px-2 py-1 text-xs text-white bg-red-600 rounded-full">
                    </span>
                </button>

                <!-- Panel Notifikasi -->
                <div x-show="open" x-transition
                    class="absolute right-0 w-64 mt-2 bg-white border rounded-lg shadow-lg">
                    <div class="p-4">
                        <template x-if="notifications.length === 0">
                            <p class="text-gray-500 text-sm">Tidak ada notifikasi baru.</p>
                        </template>
                        <template x-for="notif in notifications" :key="notif.id">
                            <a :href="'{{ route('orders.show', '') }}' + '/' + notif.id"
                                class="block p-2 border-b hover:bg-slate-100">
                                {{-- <a href="{{ route('notification.index') }}" class="block p-2 border-b hover:bg-slate-100"> --}}
                                <p class="text-sm font-semibold text-gray-400">Order #<span x-text="notif.id"></span>
                                </p>
                                <p class="text-xs text-gray-600">Nama: <span x-text="notif.customer_name"></span></p>
                                <p class="text-xs text-gray-600">Status: <span x-text="notif.status"></span></p>
                                <p class="text-xs text-gray-600">Total: Rp<span x-text="notif.total_price"></span></p>
                                <p class="text-xs text-gray-400" x-text="notif.created_at"></p>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <script>
                function notificationComponent() {
                    return {
                        notifCount: 0,
                        notifications: [],
                        open: false,
                        fetchNotifications() {
                            fetch('/notifications')
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Data Notifikasi:', data); // Debugging

                                    let oldCount = this.notifCount;

                                    // Cek jika ada notifikasi baru masuk
                                    if (this.initialized && data.count > oldCount) {
                                        this.playNotificationSound(); // 🔊 Mainkan suara
                                        this.triggerNotificationAnimation(); // ✨ Animasi masuk
                                    }

                                    // tandai pemanggilan selesai
                                    this.initialized = true;

                                    // Update data Alpine.js
                                    this.notifCount = data.count;
                                    this.notifications = data.orders;
                                })
                                .catch(error => console.error('Error fetching notifications:', error));
                        },
                        playNotificationSound() {
                            let audio = new Audio('/asset-admin/public/sounds/notif.wav'); // ✅ Perbaikan path suara
                            audio.play().catch(err => console.error('Error playing sound:', err));
                        },
                        triggerNotificationAnimation() {
                            let notifButton = document.querySelector('#notif-navbar button');

                            if (notifButton) { // ✅ Pastikan elemen ditemukan sebelum ditambahkan animasi
                                notifButton.classList.add('animate-bounce');

                                setTimeout(() => {
                                    notifButton.classList.remove('animate-bounce');
                                }, 1000);
                            }
                        }
                    };
                }
            </script>

            <!-- User avatar button -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })" type="button"
                    aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                    class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none dark:focus:opacity-100">
                    <span class="sr-only">User menu</span>
                    <img class="w-12 h-12 rounded-full mt-2" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                        alt="{{ Auth::user()->name }}" />
                </button>

                <!-- User dropdown menu -->
                <div x-show="open" x-ref="userMenu" x-transition:enter="transition-all transform ease-out"
                    x-transition:enter-start="translate-y-1/2 opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition-all transform ease-in"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                    @keydown.escape="open = false"
                    class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                    tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                    <a href="{{ auth()->check() ? route('profile.show', auth()->user()->id) : '#' }}"
                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                        Your Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="#" type="button" role="menuitem"
                            onclick="event.preventDefault(); confirmLogout();"
                            class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                            Logout
                        </a>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        function confirmLogout() {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'You will be logged out. Do you want to proceed?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#b91c1c',
                                cancelButtonColor: '#facc15',
                                confirmButtonText: 'Yes, logout',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('logout-form').submit();
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </nav>

        <!-- Mobile sub menu -->
        <nav x-transition:enter="transition duration-200 ease-in-out transform sm:duration-500"
            x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
            x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-full opacity-0"
            x-show="isMobileSubMenuOpen" @click.away="isMobileSubMenuOpen = false"
            class="absolute flex items-center p-4 bg-white rounded-md shadow-lg dark:bg-darker top-16 inset-x-4 md:hidden"
            aria-label="Secondary">
            <div class="space-x-2">
                <!-- Toggle dark theme button -->
                <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                    <div class="w-12 h-6 transition rounded-full outline-none bg-slate-400"></div>
                    <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                        :class="{
                            'translate-x-0 -translate-y-px bg-yellow-300 text-white': !isDark,
                            'translate-x-6 text-primary-100 bg-red-700': isDark
                        }">
                        <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                </button>

                <!-- Notification button with panel -->
                <div id="notif-navbar" class="z-10" x-data="notificationComponent()" x-init="fetchNotifications();
                setInterval(() => fetchNotifications(), 5000)">
                    <button @click="open = !open"
                        class="relative p-2 transition-colors duration-200 rounded-full text-white bg-yellow-300 dark:bg-red-700 hover:bg-red-700 dark:hover:text-light dark:hover:bg-amber-300">
                        <span class="sr-only">Open Notification panel</span>
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <!-- Badge Notifikasi -->
                        <span x-show="notifCount > 0" x-text="notifCount"
                            class="absolute top-0 right-0 -mt-1 -mr-1 px-2 py-1 text-xs text-white bg-red-600 rounded-full"></span>
                    </button>

                    <!-- Panel Notifikasi -->
                    <div x-show="open" x-transition
                        class="absolute right-0 w-64 mt-2 bg-white border rounded-lg shadow-lg">
                        <div class="p-4">
                            <template x-if="notifications.length === 0">
                                <p class="text-gray-500 text-sm">Tidak ada notifikasi baru.</p>
                            </template>
                            <template x-for="notif in notifications" :key="notif.id">
                                <a :href="'{{ route('orders.show', '') }}' + '/' + notif.id"
                                    class="block p-2 border-b hover:bg-slate-100">
                                    <p class="text-sm font-semibold text-gray-400">Order #<span
                                            x-text="notif.id"></span></p>
                                    <p class="text-xs text-gray-600">Nama: <span x-text="notif.customer_name"></span>
                                    </p>
                                    <p class="text-xs text-gray-600">Status: <span x-text="notif.status"></span></p>
                                    <p class="text-xs text-gray-600">Total: Rp<span x-text="notif.total_price"></span>
                                    </p>
                                    <p class="text-xs text-gray-400" x-text="notif.created_at"></p>
                                </a>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- User avatar button -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                        type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                        class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                        <span class="sr-only">User menu</span>
                        <img class="w-10 h-10 rounded-full mt-2"
                            src="{{ asset('asset-admin/public/img/person.jpg') }}" alt="User Avatar" />
                    </button>

                    <!-- User dropdown menu -->
                    <div x-show="open" x-ref="userMenu" x-transition:enter="transition-all transform ease-out"
                        x-transition:enter-start="translate-y-1/2 opacity-0"
                        x-transition:enter-end="translate-y-0 opacity-100"
                        x-transition:leave="transition-all transform ease-in"
                        x-transition:leave-start="translate-y-0 opacity-100"
                        x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                        @keydown.escape="open = false"
                        class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                        tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                        <a href="{{ auth()->check() ? route('profile.show', auth()->user()->id) : '#' }}"
                            class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
                            role="menuitem">
                            Your Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); confirmLogout();"
                                class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
                                role="menuitem">
                                Logout
                            </a>
                        </form>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            function confirmLogout() {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: 'You will be logged out. Do you want to proceed?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#b91c1c',
                                    cancelButtonColor: '#facc15',
                                    confirmButtonText: 'Yes, logout',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('logout-form').submit();
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>

            </div>
        </nav>
    </div>
    <!-- Mobile main manu -->
    <div class="border-b md:hidden dark:border-slate-950" x-show="isMobileMainMenuOpen"
        @click.away="isMobileMainMenuOpen = false">
        <nav aria-label="Main" class="px-2 py-4 space-y-2">
            <!-- Dashboard -->
            <div x-data="{ isActive: {{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive }" role="button">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Dashboard </span>
                </a>
            </div>

            <!-- Products -->
            <div x-data="{ isActive: {{ request()->routeIs('products.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('products.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive }" role="button">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"
                            class="w-5 h-5 dark:text-gray-500 text-slate-400" stroke="currentColor"
                            fill="currentColor">
                            <g data-name="fork spoon">
                                <path
                                    d="M55.22 9.43a3 3 0 0 0-2 .87 3 3 0 0 0-.87 2.11v16.67a4.59 4.59 0 0 1-4.16 4.63 4.49 4.49 0 0 1-4.82-4.48V12.65a3.35 3.35 0 0 0-1-2.4 2.86 2.86 0 0 0-2.08-.82 3 3 0 0 0-2 .87 3 3 0 0 0-.87 2.11v16.82a4.49 4.49 0 1 1-9 0V12.65a3.36 3.36 0 0 0-1-2.39 2.8 2.8 0 0 0-2-.83h-.08a2.94 2.94 0 0 0-2 .87 3 3 0 0 0-.88 2.11v22.86c0 6.89 5.66 12.55 10.5 15.3a7 7 0 0 1 3.54 6.64l-4.15 52.41a8.94 8.94 0 0 0 2.43 6.51 7.63 7.63 0 0 0 11.19 0 9 9 0 0 0 2.43-6.58l-4.13-52.06a7 7 0 0 1 4.24-7A17.23 17.23 0 0 0 53 47.94a17.82 17.82 0 0 0 5.25-12.67V12.66a3.36 3.36 0 0 0-1-2.39 2.85 2.85 0 0 0-2.03-.84zM87.63 8.64a17.93 17.93 0 0 0-17.92 17.91v9.5c0 6.88 5.64 12.53 10.46 15.28A7 7 0 0 1 83.71 58l-4.11 52.24a9.18 9.18 0 0 0 2.49 6.69 7.52 7.52 0 0 0 11.07 0 9.25 9.25 0 0 0 2.49-6.77L91.54 58a7 7 0 0 1 3.54-6.64c4.82-2.75 10.46-8.4 10.46-15.28v-9.5A17.91 17.91 0 0 0 87.63 8.64zm9.91 19.91a2 2 0 0 1-2-2 7.92 7.92 0 0 0-7.91-7.91 2 2 0 0 1 0-4 11.93 11.93 0 0 1 11.91 11.91 2 2 0 0 1-2 2z" />
                            </g>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Products </span>
                </a>
            </div>

            <!-- Orders -->
            <div x-data="{ isActive: {{ request()->routeIs('orders.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('orders.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive }" role="button">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5" fill="none"
                            stroke="currentColor" viewBox="0 0 48 48">
                            <path
                                d="M 20.5 4 C 18.203405 4 16.305701 5.7666235 16.050781 8 L 12.5 8 C 10.032499 8 8 10.032499 8 12.5 L 8 39.5 C 8 41.967501 10.032499 44 12.5 44 L 35.5 44 C 37.967501 44 40 41.967501 40 39.5 L 40 12.5 C 40 10.032499 37.967501 8 35.5 8 L 31.949219 8 C 31.694299 5.7666235 29.796595 4 27.5 4 L 20.5 4 z M 20.5 7 L 27.5 7 C 28.346499 7 29 7.6535009 29 8.5 C 29 9.3464991 28.346499 10 27.5 10 L 20.5 10 C 19.653501 10 19 9.3464991 19 8.5 C 19 7.6535009 19.653501 7 20.5 7 z M 12.5 11 L 16.769531 11 C 17.581237 12.2019 18.954719 13 20.5 13 L 27.5 13 C 29.045281 13 30.418763 12.2019 31.230469 11 L 35.5 11 C 36.346499 11 37 11.653501 37 12.5 L 37 39.5 C 37 40.346499 36.346499 41 35.5 41 L 12.5 41 C 11.653501 41 11 40.346499 11 39.5 L 11 12.5 C 11 11.653501 11.653501 11 12.5 11 z M 16.5 20 A 1.5 1.5 0 0 0 16.5 23 A 1.5 1.5 0 0 0 16.5 20 z M 22.5 20 A 1.50015 1.50015 0 1 0 22.5 23 L 31.5 23 A 1.50015 1.50015 0 1 0 31.5 20 L 22.5 20 z M 16.5 26 A 1.5 1.5 0 0 0 16.5 29 A 1.5 1.5 0 0 0 16.5 26 z M 22.5 26 A 1.50015 1.50015 0 1 0 22.5 29 L 31.5 29 A 1.50015 1.50015 0 1 0 31.5 26 L 22.5 26 z M 16.5 32 A 1.5 1.5 0 0 0 16.5 35 A 1.5 1.5 0 0 0 16.5 32 z M 22.5 32 A 1.50015 1.50015 0 1 0 22.5 35 L 31.5 35 A 1.50015 1.50015 0 1 0 31.5 32 L 22.5 32 z">
                            </path>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Orders </span>
                </a>
            </div>

            <!-- Histories -->
            <div x-data="{ isActive: {{ request()->routeIs('histories.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('histories.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive }" role="button">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-5 h-5" fill="none"
                            stroke="currentColor" viewBox="0 0 48 48">
                            <path
                                d="M 24 4 C 17.46415 4 11.651148 7.1491633 8 12.011719 L 8 8.5 A 1.50015 1.50015 0 0 0 6.4765625 6.9785156 A 1.50015 1.50015 0 0 0 5 8.5 L 5 15.5 A 1.50015 1.50015 0 0 0 6.5 17 L 13.5 17 A 1.50015 1.50015 0 1 0 13.5 14 L 10.25 14 C 13.339079 9.7581979 18.339176 7 24 7 C 33.406292 7 41 14.593708 41 24 C 41 33.406292 33.406292 41 24 41 C 14.593708 41 7 33.406292 7 24 A 1.50015 1.50015 0 1 0 4 24 C 4 35.027708 12.972292 44 24 44 C 35.027708 44 44 35.027708 44 24 C 44 12.972292 35.027708 4 24 4 z M 23.476562 12.978516 A 1.50015 1.50015 0 0 0 22 14.5 L 22 26.5 A 1.50015 1.50015 0 0 0 23.5 28 L 31.5 28 A 1.50015 1.50015 0 1 0 31.5 25 L 25 25 L 25 14.5 A 1.50015 1.50015 0 0 0 23.476562 12.978516 z">
                            </path>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Histories </span>
                </a>
            </div>

            <!-- Categories -->
            <div x-data="{ isActive: {{ request()->routeIs('categories.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('categories.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive }" role="button">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-5 h-5" stroke="currentColor"
                            fill="none" viewBox="0 0 48 48">
                            <path
                                d="M 14.5 6 C 9.8233445 6 6 9.8233481 6 14.5 C 6 19.176652 9.8233445 23 14.5 23 C 19.176656 23 23 19.176652 23 14.5 C 23 9.8233481 19.176656 6 14.5 6 z M 30.5 7 C 28.032499 7 26 9.0324991 26 11.5 L 26 17.5 C 26 19.967501 28.032499 22 30.5 22 L 36.5 22 C 38.967501 22 41 19.967501 41 17.5 L 41 11.5 C 41 9.0324991 38.967501 7 36.5 7 L 30.5 7 z M 14.5 9 C 17.555336 9 20 11.444666 20 14.5 C 20 17.555334 17.555336 20 14.5 20 C 11.444664 20 9 17.555334 9 14.5 C 9 11.444666 11.444664 9 14.5 9 z M 30.5 10 L 36.5 10 C 37.346499 10 38 10.653501 38 11.5 L 38 17.5 C 38 18.346499 37.346499 19 36.5 19 L 30.5 19 C 29.653501 19 29 18.346499 29 17.5 L 29 11.5 C 29 10.653501 29.653501 10 30.5 10 z M 33.492188 24.996094 C 32.529032 24.992777 31.566359 25.285162 30.75 25.875 L 26.708984 28.791016 C 25.075025 29.969055 24.382097 32.079152 24.998047 33.996094 L 26.523438 38.742188 C 27.139212 40.658585 28.931978 41.969843 30.945312 41.976562 L 35.929688 41.992188 C 37.943002 41.998688 39.74451 40.699155 40.373047 38.787109 L 41.929688 34.052734 C 42.558892 32.140126 41.877598 30.024458 40.251953 28.835938 L 36.230469 25.892578 L 36.230469 25.894531 C 35.41769 25.299226 34.455343 24.99941 33.492188 24.996094 z M 14.5 26.0625 C 13.130223 26.0625 11.761449 26.722757 11.007812 28.042969 L 6.546875 35.859375 C 5.0294663 38.51903 6.9738989 42 10.039062 42 L 18.960938 42 C 22.026778 42 23.970983 38.519475 22.453125 35.859375 L 17.994141 28.042969 C 17.240504 26.722757 15.869777 26.0625 14.5 26.0625 z M 33.482422 27.990234 C 33.823766 27.991434 34.165764 28.099707 34.458984 28.314453 L 38.480469 31.255859 A 1.50015 1.50015 0 0 0 38.482422 31.257812 C 39.067811 31.685475 39.3067 32.426369 39.080078 33.115234 A 1.50015 1.50015 0 0 0 39.078125 33.115234 L 37.523438 37.849609 C 37.296177 38.540947 36.665351 38.994836 35.939453 38.992188 L 30.955078 38.976562 C 30.229204 38.974463 29.600933 38.515204 29.378906 37.824219 L 27.855469 33.080078 C 27.633419 32.38902 27.876809 31.64857 28.464844 31.224609 A 1.50015 1.50015 0 0 0 28.464844 31.222656 L 32.505859 28.306641 C 32.7995 28.094479 33.141078 27.989051 33.482422 27.990234 z M 14.5 28.9375 C 14.831223 28.9375 15.163309 29.134509 15.388672 29.529297 L 19.847656 37.345703 C 20.301798 38.141603 19.809097 39 18.960938 39 L 10.039062 39 C 9.1909031 39 8.6976149 38.141824 9.1523438 37.345703 L 13.613281 29.529297 C 13.838644 29.134509 14.168777 28.9375 14.5 28.9375 z">
                            </path>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Categories </span>
                </a>
            </div>

            <!-- Staffs -->
            <div x-data="{ isActive: {{ request()->routeIs('staffs.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('staffs.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive }" role="button">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.0002 5.33325C17.4147 5.33325 18.7712 5.89515 19.7714 6.89535C20.7716 7.89554 21.3335 9.2521 21.3335 10.6666C21.3335 12.0811 20.7716 13.4376 19.7714 14.4378C18.7712 15.438 17.4147 15.9999 16.0002 15.9999C14.5857 15.9999 13.2291 15.438 12.2289 14.4378C11.2287 13.4376 10.6668 12.0811 10.6668 10.6666C10.6668 9.2521 11.2287 7.89554 12.2289 6.89535C13.2291 5.89515 14.5857 5.33325 16.0002 5.33325ZM16.0002 18.6666C21.8935 18.6666 26.6668 21.0533 26.6668 23.9999V26.6666H5.3335V23.9999C5.3335 21.0533 10.1068 18.6666 16.0002 18.6666Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Staffs </span>
                </a>
            </div>

            <!-- Reviews -->
            <div x-data="{ isActive: {{ request()->routeIs('reviews.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('reviews.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive }" role="button">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 28 26" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.736 26L14 25L18 18H24C24.2628 18.0004 24.523 17.9489 24.7658 17.8486C25.0087 17.7482 25.2293 17.6009 25.4151 17.4151C25.6009 17.2293 25.7482 17.0087 25.8486 16.7658C25.9489 16.523 26.0004 16.2628 26 16V4C26.0004 3.73725 25.9489 3.477 25.8486 3.23417C25.7482 2.99134 25.6009 2.7707 25.4151 2.58491C25.2293 2.39911 25.0087 2.25181 24.7658 2.15144C24.523 2.05107 24.2628 1.9996 24 2H4C3.73725 1.9996 3.477 2.05107 3.23417 2.15144C2.99134 2.25181 2.7707 2.39911 2.58491 2.58491C2.39911 2.7707 2.25181 2.99134 2.15144 3.23417C2.05107 3.477 1.9996 3.73725 2 4V16C1.9996 16.2628 2.05107 16.523 2.15144 16.7658C2.25181 17.0087 2.39911 17.2293 2.58491 17.4151C2.7707 17.6009 2.99134 17.7482 3.23417 17.8486C3.477 17.9489 3.73725 18.0004 4 18H13V20H4C2.93913 20 1.92172 19.5786 1.17157 18.8284C0.421427 18.0783 0 17.0609 0 16V4C0 2.93913 0.421427 1.92172 1.17157 1.17157C1.92172 0.421427 2.93913 0 4 0H24C25.0609 0 26.0783 0.421427 26.8284 1.17157C27.5786 1.92172 28 2.93913 28 4V16C28 17.0609 27.5786 18.0783 26.8284 18.8284C26.0783 19.5786 25.0609 20 24 20H19.165L15.736 26Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Reviews </span>
                </a>
            </div>
        </nav>
    </div>

</header>

<script>
    function updateClock() {
        let now = new Date();

        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');
        let seconds = now.getSeconds().toString().padStart(2, '0');

        let days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        let dayName = days[now.getDay()];

        document.getElementById('real-time-clock').innerText = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateClock, 1000); // Update setiap detik
    updateClock(); // Langsung panggil agar tidak menunggu 1 detik pertama
</script>
