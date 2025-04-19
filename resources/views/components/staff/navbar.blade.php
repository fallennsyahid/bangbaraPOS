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
                            <a :href="'{{ route('staffOrders.show', '') }}' + '/' + notif.id"
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
                    <img class="w-12 h-12 rounded-full mt-2"
                        src="{{ Auth::check() ? Avatar::create(Auth::user()->name)->toBase64() : asset('default-avatar.png') }}"
                        alt="User Profile" />
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
                    <a href="{{ auth()->check() ? route('staffProfile.show', auth()->user()->id) : '#' }}"
                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                        Your Profile
                    </a>

                    <a href="{{ route('staffSettings.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                        Settings
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
                        <a href="{{ route('staffSettings.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
                            role="menuitem">
                            Settings
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
            <div x-data="{ isActive: {{ request()->routeIs('staff.dashboard') ? 'true' : 'false' }}, open: false }">
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

            <!-- Orders -->
            <div x-data="{ isActive: {{ request()->routeIs('staffOrders.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('staffOrders.index') }}"
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
            <div x-data="{ isActive: {{ request()->routeIs('staffHistories.index') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('staffHistories.index') }}"
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
