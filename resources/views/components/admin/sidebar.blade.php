<!-- Sidebar -->
<aside class="flex-shrink-0 hidden w-64 bg-white dark:bg-[#000000] md:block">
    <div class="flex flex-col h-full">
        <img src="{{ asset('asset-view/assets/svg/logo-navbar.svg') }}" height="50" class="p-4" alt="">
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <!-- Dashboards links -->
            <div x-data="{ isActive: true, open: true }">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500
   {{ request()->routeIs('admin.dashboard') ? 'bg-red-700 text-white' : '' }}"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Dashboard </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                    <a href="{{ route('admin.dashboard') }}" role="menuitem"
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                        Home
                    </a>

                </div>
            </div>

            <!-- Products links -->
            <div x-data="{ isActive: false, open: false }">
                <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500
                    {{ request()->routeIs('products.index') ? 'bg-red-700 text-white' : '' }}"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"
                            class="w-5 h-5 dark:text-gray-500 text-slate-400" stroke="currentColor" fill="currentColor">
                            <g data-name="fork spoon">
                                <path
                                    d="M55.22 9.43a3 3 0 0 0-2 .87 3 3 0 0 0-.87 2.11v16.67a4.59 4.59 0 0 1-4.16 4.63 4.49 4.49 0 0 1-4.82-4.48V12.65a3.35 3.35 0 0 0-1-2.4 2.86 2.86 0 0 0-2.08-.82 3 3 0 0 0-2 .87 3 3 0 0 0-.87 2.11v16.82a4.49 4.49 0 1 1-9 0V12.65a3.36 3.36 0 0 0-1-2.39 2.8 2.8 0 0 0-2-.83h-.08a2.94 2.94 0 0 0-2 .87 3 3 0 0 0-.88 2.11v22.86c0 6.89 5.66 12.55 10.5 15.3a7 7 0 0 1 3.54 6.64l-4.15 52.41a8.94 8.94 0 0 0 2.43 6.51 7.63 7.63 0 0 0 11.19 0 9 9 0 0 0 2.43-6.58l-4.13-52.06a7 7 0 0 1 4.24-7A17.23 17.23 0 0 0 53 47.94a17.82 17.82 0 0 0 5.25-12.67V12.66a3.36 3.36 0 0 0-1-2.39 2.85 2.85 0 0 0-2.03-.84zM87.63 8.64a17.93 17.93 0 0 0-17.92 17.91v9.5c0 6.88 5.64 12.53 10.46 15.28A7 7 0 0 1 83.71 58l-4.11 52.24a9.18 9.18 0 0 0 2.49 6.69 7.52 7.52 0 0 0 11.07 0 9.25 9.25 0 0 0 2.49-6.77L91.54 58a7 7 0 0 1 3.54-6.64c4.82-2.75 10.46-8.4 10.46-15.28v-9.5A17.91 17.91 0 0 0 87.63 8.64zm9.91 19.91a2 2 0 0 1-2-2 7.92 7.92 0 0 0-7.91-7.91 2 2 0 0 1 0-4 11.93 11.93 0 0 1 11.91 11.91 2 2 0 0 1-2 2z" />
                            </g>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Products </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                    <a href="{{ route('products.index') }}" role="menuitem"
                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        Manage Products
                    </a>
                </div>
            </div>

            <!-- Orders links -->
            <div x-data="{ isActive: false, open: false }">
                <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500
                    {{ request()->routeIs('orders.index') ? 'bg-red-700 text-white' : '' }}"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5" fill="none"
                            stroke="currentColor" viewBox="0 0 48 48">
                            <path
                                d="M 20.5 4 C 18.203405 4 16.305701 5.7666235 16.050781 8 L 12.5 8 C 10.032499 8 8 10.032499 8 12.5 L 8 39.5 C 8 41.967501 10.032499 44 12.5 44 L 35.5 44 C 37.967501 44 40 41.967501 40 39.5 L 40 12.5 C 40 10.032499 37.967501 8 35.5 8 L 31.949219 8 C 31.694299 5.7666235 29.796595 4 27.5 4 L 20.5 4 z M 20.5 7 L 27.5 7 C 28.346499 7 29 7.6535009 29 8.5 C 29 9.3464991 28.346499 10 27.5 10 L 20.5 10 C 19.653501 10 19 9.3464991 19 8.5 C 19 7.6535009 19.653501 7 20.5 7 z M 12.5 11 L 16.769531 11 C 17.581237 12.2019 18.954719 13 20.5 13 L 27.5 13 C 29.045281 13 30.418763 12.2019 31.230469 11 L 35.5 11 C 36.346499 11 37 11.653501 37 12.5 L 37 39.5 C 37 40.346499 36.346499 41 35.5 41 L 12.5 41 C 11.653501 41 11 40.346499 11 39.5 L 11 12.5 C 11 11.653501 11.653501 11 12.5 11 z M 16.5 20 A 1.5 1.5 0 0 0 16.5 23 A 1.5 1.5 0 0 0 16.5 20 z M 22.5 20 A 1.50015 1.50015 0 1 0 22.5 23 L 31.5 23 A 1.50015 1.50015 0 1 0 31.5 20 L 22.5 20 z M 16.5 26 A 1.5 1.5 0 0 0 16.5 29 A 1.5 1.5 0 0 0 16.5 26 z M 22.5 26 A 1.50015 1.50015 0 1 0 22.5 29 L 31.5 29 A 1.50015 1.50015 0 1 0 31.5 26 L 22.5 26 z M 16.5 32 A 1.5 1.5 0 0 0 16.5 35 A 1.5 1.5 0 0 0 16.5 32 z M 22.5 32 A 1.50015 1.50015 0 1 0 22.5 35 L 31.5 35 A 1.50015 1.50015 0 1 0 31.5 32 L 22.5 32 z">
                            </path>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Orders </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                    <a href="{{ route('orders.index') }}" role="menuitem"
                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        Manage Orders
                    </a>
                </div>
            </div>

            <!-- History links -->
            <div x-data="{ isActive: false, open: false }">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500
                    {{ request()->routeIs('histories.index') ? 'bg-red-700 text-white' : '' }}"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-5 h-5" fill="none"
                            stroke="currentColor" viewBox="0 0 48 48">
                            <path
                                d="M 24 4 C 17.46415 4 11.651148 7.1491633 8 12.011719 L 8 8.5 A 1.50015 1.50015 0 0 0 6.4765625 6.9785156 A 1.50015 1.50015 0 0 0 5 8.5 L 5 15.5 A 1.50015 1.50015 0 0 0 6.5 17 L 13.5 17 A 1.50015 1.50015 0 1 0 13.5 14 L 10.25 14 C 13.339079 9.7581979 18.339176 7 24 7 C 33.406292 7 41 14.593708 41 24 C 41 33.406292 33.406292 41 24 41 C 14.593708 41 7 33.406292 7 24 A 1.50015 1.50015 0 1 0 4 24 C 4 35.027708 12.972292 44 24 44 C 35.027708 44 44 35.027708 44 24 C 44 12.972292 35.027708 4 24 4 z M 23.476562 12.978516 A 1.50015 1.50015 0 0 0 22 14.5 L 22 26.5 A 1.50015 1.50015 0 0 0 23.5 28 L 31.5 28 A 1.50015 1.50015 0 1 0 31.5 25 L 25 25 L 25 14.5 A 1.50015 1.50015 0 0 0 23.476562 12.978516 z">
                            </path>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> History </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                    <a href="{{ route('histories.index') }}" role="menuitem"
                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        Manage History
                    </a>

                </div>
            </div>

            <!-- Category links -->
            <div x-data="{ isActive: false, open: false }">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500
                    {{ request()->routeIs('categories.index') ? 'bg-red-700 text-white' : '' }}"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5" stroke="currentColor"
                            fill="none" viewBox="0 0 48 48">
                            <path
                                d="M 14.5 6 C 9.8233445 6 6 9.8233481 6 14.5 C 6 19.176652 9.8233445 23 14.5 23 C 19.176656 23 23 19.176652 23 14.5 C 23 9.8233481 19.176656 6 14.5 6 z M 30.5 7 C 28.032499 7 26 9.0324991 26 11.5 L 26 17.5 C 26 19.967501 28.032499 22 30.5 22 L 36.5 22 C 38.967501 22 41 19.967501 41 17.5 L 41 11.5 C 41 9.0324991 38.967501 7 36.5 7 L 30.5 7 z M 14.5 9 C 17.555336 9 20 11.444666 20 14.5 C 20 17.555334 17.555336 20 14.5 20 C 11.444664 20 9 17.555334 9 14.5 C 9 11.444666 11.444664 9 14.5 9 z M 30.5 10 L 36.5 10 C 37.346499 10 38 10.653501 38 11.5 L 38 17.5 C 38 18.346499 37.346499 19 36.5 19 L 30.5 19 C 29.653501 19 29 18.346499 29 17.5 L 29 11.5 C 29 10.653501 29.653501 10 30.5 10 z M 33.492188 24.996094 C 32.529032 24.992777 31.566359 25.285162 30.75 25.875 L 26.708984 28.791016 C 25.075025 29.969055 24.382097 32.079152 24.998047 33.996094 L 26.523438 38.742188 C 27.139212 40.658585 28.931978 41.969843 30.945312 41.976562 L 35.929688 41.992188 C 37.943002 41.998688 39.74451 40.699155 40.373047 38.787109 L 41.929688 34.052734 C 42.558892 32.140126 41.877598 30.024458 40.251953 28.835938 L 36.230469 25.892578 L 36.230469 25.894531 C 35.41769 25.299226 34.455343 24.99941 33.492188 24.996094 z M 14.5 26.0625 C 13.130223 26.0625 11.761449 26.722757 11.007812 28.042969 L 6.546875 35.859375 C 5.0294663 38.51903 6.9738989 42 10.039062 42 L 18.960938 42 C 22.026778 42 23.970983 38.519475 22.453125 35.859375 L 17.994141 28.042969 C 17.240504 26.722757 15.869777 26.0625 14.5 26.0625 z M 33.482422 27.990234 C 33.823766 27.991434 34.165764 28.099707 34.458984 28.314453 L 38.480469 31.255859 A 1.50015 1.50015 0 0 0 38.482422 31.257812 C 39.067811 31.685475 39.3067 32.426369 39.080078 33.115234 A 1.50015 1.50015 0 0 0 39.078125 33.115234 L 37.523438 37.849609 C 37.296177 38.540947 36.665351 38.994836 35.939453 38.992188 L 30.955078 38.976562 C 30.229204 38.974463 29.600933 38.515204 29.378906 37.824219 L 27.855469 33.080078 C 27.633419 32.38902 27.876809 31.64857 28.464844 31.224609 A 1.50015 1.50015 0 0 0 28.464844 31.222656 L 32.505859 28.306641 C 32.7995 28.094479 33.141078 27.989051 33.482422 27.990234 z M 14.5 28.9375 C 14.831223 28.9375 15.163309 29.134509 15.388672 29.529297 L 19.847656 37.345703 C 20.301798 38.141603 19.809097 39 18.960938 39 L 10.039062 39 C 9.1909031 39 8.6976149 38.141824 9.1523438 37.345703 L 13.613281 29.529297 C 13.838644 29.134509 14.168777 28.9375 14.5 28.9375 z">
                            </path>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Category </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Layouts">
                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                    <a href="{{ route('categories.index') }}" role="menuitem"
                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        Manage Category
                    </a>
                </div>
            </div>

            {{-- Staff Links --}}
            <div x-data="{ isActive: false, open: false }">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-amber-200 dark:hover:bg-red-500
                    {{ request()->routeIs('staffs.index') ? 'bg-red-700 text-white' : '' }}"
                    :class="{ 'bg-amber-300 dark:bg-red-700': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.0002 5.33325C17.4147 5.33325 18.7712 5.89515 19.7714 6.89535C20.7716 7.89554 21.3335 9.2521 21.3335 10.6666C21.3335 12.0811 20.7716 13.4376 19.7714 14.4378C18.7712 15.438 17.4147 15.9999 16.0002 15.9999C14.5857 15.9999 13.2291 15.438 12.2289 14.4378C11.2287 13.4376 10.6668 12.0811 10.6668 10.6666C10.6668 9.2521 11.2287 7.89554 12.2289 6.89535C13.2291 5.89515 14.5857 5.33325 16.0002 5.33325ZM16.0002 18.6666C21.8935 18.6666 26.6668 21.0533 26.6668 23.9999V26.6666H5.3335V23.9999C5.3335 21.0533 10.1068 18.6666 16.0002 18.6666Z"
                                fill="currentColor" />
                        </svg>

                    </span>
                    <span class="ml-2 text-sm"> Staff </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Layouts">
                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                    <a href="{{ route('staffs.index') }}" role="menuitem"
                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        Manage Staffs
                    </a>
                </div>
            </div>
        </nav>

        <!-- Sidebar footer -->
        <div class="flex-shrink-0 px-2 py-4 space-y-2">
            <button @click="openSettingsPanel" type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-amber-300 dark:bg-red-700 hover:bg-amber-400 hover:dark:bg-red-800 focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                <span aria-hidden="true">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </span>
                <span>Customize</span>
            </button>
        </div>
    </div>
</aside>
