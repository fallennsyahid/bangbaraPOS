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

                <!-- Main content -->
                <main class="bg-prime">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4">
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Histories</h1>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        {{-- Card Status --}}
                        <div class="px-4 pb-4 max-w-6xl w-full">
                            <div class="border-2 border-gray-400 bg-thead rounded-lg shadow-lg p-6">
                                {{-- Status --}}
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                                    {{-- Completed --}}
                                    <div
                                        class="flex flex-col items-center justify-center gap-2 p-4 bg-tbody rounded-lg shadow-md">
                                        <svg width="64px" height="64px" viewBox="0 0 1024.00 1024.00" fill="#000000"
                                            class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            stroke="#000000" stroke-width="30.72">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M824.8 1003.2H203.2c-12.8 0-25.6-2.4-37.6-7.2-11.2-4.8-21.6-12-30.4-20.8-8.8-8.8-16-19.2-20.8-30.4-4.8-12-7.2-24-7.2-37.6V260c0-12.8 2.4-25.6 7.2-37.6 4.8-11.2 12-21.6 20.8-30.4 8.8-8.8 19.2-16 30.4-20.8 12-4.8 24-7.2 37.6-7.2h94.4v48H203.2c-26.4 0-48 21.6-48 48v647.2c0 26.4 21.6 48 48 48h621.6c26.4 0 48-21.6 48-48V260c0-26.4-21.6-48-48-48H730.4v-48H824c12.8 0 25.6 2.4 37.6 7.2 11.2 4.8 21.6 12 30.4 20.8 8.8 8.8 16 19.2 20.8 30.4 4.8 12 7.2 24 7.2 37.6v647.2c0 12.8-2.4 25.6-7.2 37.6-4.8 11.2-12 21.6-20.8 30.4-8.8 8.8-19.2 16-30.4 20.8-11.2 4.8-24 7.2-36.8 7.2z"
                                                    fill=""></path>
                                                <path
                                                    d="M752.8 308H274.4V152.8c0-32.8 26.4-60 60-60h61.6c22.4-44 67.2-72.8 117.6-72.8 50.4 0 95.2 28.8 117.6 72.8h61.6c32.8 0 60 26.4 60 60v155.2m-430.4-48h382.4V152.8c0-6.4-5.6-12-12-12H598.4l-5.6-16c-12-33.6-43.2-56-79.2-56s-67.2 22.4-79.2 56l-5.6 16H334.4c-6.4 0-12 5.6-12 12v107.2zM432.8 792c-6.4 0-12-2.4-16.8-7.2L252.8 621.6c-4.8-4.8-7.2-10.4-7.2-16.8s2.4-12 7.2-16.8c4.8-4.8 10.4-7.2 16.8-7.2s12 2.4 16.8 7.2L418.4 720c4 4 8.8 5.6 13.6 5.6s10.4-1.6 13.6-5.6l295.2-295.2c4.8-4.8 10.4-7.2 16.8-7.2s12 2.4 16.8 7.2c9.6 9.6 9.6 24 0 33.6L449.6 784.8c-4.8 4-11.2 7.2-16.8 7.2z"
                                                    fill=""></path>
                                            </g>
                                        </svg>
                                        <span class="text-white text-lg font-semibold">{{ $total_histories_completed }}</span>
                                    </div>
                                    {{-- Canceled --}}
                                    <div
                                        class="flex flex-col items-center justify-center gap-2 p-4 bg-tbody rounded-lg shadow-md">
                                        <svg width="64px" height="64px" viewBox="0 0 512 512" fill="#000000">
                                            <path
                                                d="M213.333333,1.42108547e-14 C331.15408,1.42108547e-14 426.666667,95.5125867 426.666667,213.333333 C426.666667,331.15408 331.15408,426.666667 213.333333,426.666667 C95.5125867,426.666667 4.26325641e-14,331.15408 4.26325641e-14,213.333333 C4.26325641e-14,95.5125867 95.5125867,1.42108547e-14 213.333333,1.42108547e-14 Z M42.6666667,213.333333 C42.6666667,307.589931 119.076736,384 213.333333,384 C252.77254,384 289.087204,370.622239 317.987133,348.156908 L78.5096363,108.679691 C56.044379,137.579595 42.6666667,173.894198 42.6666667,213.333333 Z M213.333333,42.6666667 C173.894198,42.6666667 137.579595,56.044379 108.679691,78.5096363 L348.156908,317.987133 C370.622239,289.087204 384,252.77254 384,213.333333 C384,119.076736 307.589931,42.6666667 213.333333,42.6666667 Z" />
                                        </svg>
                                        <span class="text-white text-lg font-semibold">{{ $total_histories_cancelled }}</span>
                                    </div>
                                </div>

                                {{-- Status Description --}}
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                                    {{-- Complete --}}
                                    <span class="flex items-center text-black text-sm font-medium">
                                        <svg width="32px" height="32px" viewBox="0 0 1024.00 1024.00" fill="#000000"
                                            class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            stroke="#000000" stroke-width="30.72">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M824.8 1003.2H203.2c-12.8 0-25.6-2.4-37.6-7.2-11.2-4.8-21.6-12-30.4-20.8-8.8-8.8-16-19.2-20.8-30.4-4.8-12-7.2-24-7.2-37.6V260c0-12.8 2.4-25.6 7.2-37.6 4.8-11.2 12-21.6 20.8-30.4 8.8-8.8 19.2-16 30.4-20.8 12-4.8 24-7.2 37.6-7.2h94.4v48H203.2c-26.4 0-48 21.6-48 48v647.2c0 26.4 21.6 48 48 48h621.6c26.4 0 48-21.6 48-48V260c0-26.4-21.6-48-48-48H730.4v-48H824c12.8 0 25.6 2.4 37.6 7.2 11.2 4.8 21.6 12 30.4 20.8 8.8 8.8 16 19.2 20.8 30.4 4.8 12 7.2 24 7.2 37.6v647.2c0 12.8-2.4 25.6-7.2 37.6-4.8 11.2-12 21.6-20.8 30.4-8.8 8.8-19.2 16-30.4 20.8-11.2 4.8-24 7.2-36.8 7.2z"
                                                    fill=""></path>
                                                <path
                                                    d="M752.8 308H274.4V152.8c0-32.8 26.4-60 60-60h61.6c22.4-44 67.2-72.8 117.6-72.8 50.4 0 95.2 28.8 117.6 72.8h61.6c32.8 0 60 26.4 60 60v155.2m-430.4-48h382.4V152.8c0-6.4-5.6-12-12-12H598.4l-5.6-16c-12-33.6-43.2-56-79.2-56s-67.2 22.4-79.2 56l-5.6 16H334.4c-6.4 0-12 5.6-12 12v107.2zM432.8 792c-6.4 0-12-2.4-16.8-7.2L252.8 621.6c-4.8-4.8-7.2-10.4-7.2-16.8s2.4-12 7.2-16.8c4.8-4.8 10.4-7.2 16.8-7.2s12 2.4 16.8 7.2L418.4 720c4 4 8.8 5.6 13.6 5.6s10.4-1.6 13.6-5.6l295.2-295.2c4.8-4.8 10.4-7.2 16.8-7.2s12 2.4 16.8 7.2c9.6 9.6 9.6 24 0 33.6L449.6 784.8c-4.8 4-11.2 7.2-16.8 7.2z"
                                                    fill=""></path>
                                            </g>
                                        </svg>
                                        = Completed
                                    </span>
                                    {{-- Cancel --}}
                                    <span class="flex items-center text-black text-sm font-medium">
                                        <svg width="32px" height="32px" viewBox="0 0 512 512" fill="#000000">
                                            <path
                                                d="M213.333333,1.42108547e-14 C331.15408,1.42108547e-14 426.666667,95.5125867 426.666667,213.333333 C426.666667,331.15408 331.15408,426.666667 213.333333,426.666667 C95.5125867,426.666667 4.26325641e-14,331.15408 4.26325641e-14,213.333333 C4.26325641e-14,95.5125867 95.5125867,1.42108547e-14 213.333333,1.42108547e-14 Z M42.6666667,213.333333 C42.6666667,307.589931 119.076736,384 213.333333,384 C252.77254,384 289.087204,370.622239 317.987133,348.156908 L78.5096363,108.679691 C56.044379,137.579595 42.6666667,173.894198 42.6666667,213.333333 Z M213.333333,42.6666667 C173.894198,42.6666667 137.579595,56.044379 108.679691,78.5096363 L348.156908,317.987133 C370.622239,289.087204 384,252.77254 384,213.333333 C384,119.076736 307.589931,42.6666667 213.333333,42.6666667 Z" />
                                        </svg>
                                        = Canceled
                                    </span>
                                </div>
                            </div>
                        </div>


                        
                        <div class="mb-4 mt-3 flex justify-between w-full max-h-full max-w-6xl">
                            <a href="#" id="exportExcel"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg mt-20 self-start">
                                <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                    class="w-5 h-5 inline-block mr-2">
                                Export
                            </a>
                            <div class="p-2">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Periode</h2>

                            <form id="filterForm" class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <label for="periode_awal" class="text-gray-700 text-sm font-medium">Periode
                                            Awal</label>
                                        <input type="date" id="periode_awal" name="periode_awal"
                                            class="text-white mt-1 block w-48 px-3 py-2 border border-[#CC0000] bg-[#CC0000] rounded-md shadow-sm">
                                    </div>

                                    <span class="text-gray-700 mt-4">-</span>

                                    <div>
                                        <label for="periode_akhir" class="text-gray-700 text-sm font-medium">Periode
                                            Akhir</label>
                                        <input type="date" id="periode_akhir" name="periode_akhir"
                                            class="text-white mt-1 block w-48 px-3 py-2 border border-[#CC0000] bg-[#CC0000] rounded-md shadow-sm">
                                    </div>
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 mt-6 px-4 rounded-lg shadow-md">
                                        Filter
                                    </button>
                                </form>
                            </div>

                        </div>
                            <button id="bulkDeleteButton"
                                class="bg-red-700 text-white px-4 py-2 rounded-lg hidden self-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" class="inline-block">
                                        <path fill="red"
                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                </svg>
                                Delete
                                Selected</button>

                        </div>
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">
                            <div class="flex mx-auto justify-between">
                            </div>
                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            <input type="checkbox" id="select-all" />
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Casier</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Costumer</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Date</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Total</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Method</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Status</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody id="productTable" class="bg-tbody">
                                    @forelse ($histories as $index => $history)
                                        <tr class="hover:bg-thead" data-category="{{ $history->id }}">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                <input type="checkbox" class="select-item" value="{{ $history->id }}">
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                #{{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->casier_name }}
                                            </td>
                                            <td id="customer-name-{{ $history->id }}"
                                                class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->customer_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->created_at->format('d/m/y') }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">Rp
                                                {{ number_format($history->total_price, 2) }}</td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900"
                                                id="history-status-{{ $history->id }}">
                                                <h5
                                                    class="
                                                             {{ $history->status == 'Cancelled' ? 'text-red-700 font-extrabold' : '' }}
                                                    ">
                                                    {{ $history->status }}</h4>
                                            </td>

                                            <td class="px-6 py-4 flex items-center gap-3 mt-4">
                                                <a href="{{ route('histories.show', $history->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                <form id="delete-form-{{ $history->id }}"
                                                    action="{{ route('histories.destroy', $history->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $history->id }})">
                                                        <path fill="red"
                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg>
                                                </form>

                                                {{-- ini untuk cetak struk --}}

                                                @if ($history->status == 'Completed')
                                                <a href="javascript:void(0);"
                                                    onclick="printReceipt('{{ $history->id }}')"><svg width="42"
                                                        height="42" viewBox="0 0 42 42" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M28.2851 23.8717H28.9156C30.1048 23.8717 30.6987 23.8717 31.0682 23.5022C31.4377 23.1328 31.4377 22.5388 31.4377 21.3496V20.0886C31.4377 17.7103 31.4377 16.5224 30.6987 15.7834C29.9598 15.0444 28.7719 15.0444 26.3935 15.0444H15.0442C12.6658 15.0444 11.4779 15.0444 10.739 15.7834C10 16.5224 10 17.7103 10 20.0886V22.6107C10 23.2046 10 23.5022 10.1841 23.6876C10.3695 23.8717 10.6671 23.8717 11.261 23.8717H13.1526"
                                                            stroke="#9F6802" stroke-width="1.33333" />
                                                        <path
                                                            d="M13.7832 31.8239V21.3497C13.7832 20.1606 13.7832 19.5666 14.1527 19.1971C14.5222 18.8276 15.1161 18.8276 16.3053 18.8276H25.1326C26.3217 18.8276 26.9157 18.8276 27.2852 19.1971C27.6547 19.5666 27.6547 20.1606 27.6547 21.3497V31.8239C27.6547 32.2237 27.6547 32.4229 27.5235 32.5175C27.3924 32.6121 27.2032 32.549 26.8249 32.4229L24.091 31.5112C24.022 31.4806 23.9481 31.4627 23.8728 31.4582C23.7976 31.467 23.7245 31.4892 23.6572 31.5238L20.9535 32.6058C20.8806 32.644 20.8009 32.6676 20.7189 32.6751C20.637 32.6676 20.5573 32.644 20.4844 32.6058L17.7807 31.5238C17.6748 31.4809 17.6218 31.4608 17.5663 31.4582C17.5108 31.4557 17.4554 31.4746 17.3469 31.5112L14.613 32.4229C14.2347 32.549 14.0455 32.6121 13.9144 32.5175C13.7832 32.4229 13.7832 32.2237 13.7832 31.8239Z"
                                                            stroke="#9F6802" stroke-width="1.33333" />
                                                        <path d="M17.5664 23.8711H22.6106M17.5664 27.6542H23.8716"
                                                            stroke="#9F6802" stroke-width="1.33333"
                                                            stroke-linecap="round" />
                                                        <path
                                                            d="M27.6547 15.0442V14.5398C27.6547 12.3998 27.6547 11.3291 26.9901 10.6646C26.3255 10 25.2549 10 23.1149 10H18.323C16.183 10 15.1123 10 14.4478 10.6646C13.7832 11.3291 13.7832 12.3998 13.7832 14.5398V15.0442"
                                                            stroke="#9F6802" stroke-width="1.33333" />
                                                    </svg>
                                                </a>
                                                @endif

                                                <!-- Button panggil pelanggan -->
                                                @if ($history->status == 'Completed')
                                                    <button onclick="panggilNama({{ $history->id }})">
                                                        <svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="28px"
                                                            height="28px" viewBox="0 0 64 64"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#000000">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#000000"
                                                                        d="M59.998,28.001h-7.999c-2.211,0-4,1.789-4,4s1.789,4,4,4h7.999c2.211,0,4-1.789,4-4 S62.209,28.001,59.998,28.001z">
                                                                    </path>
                                                                    <path fill="#000000"
                                                                        d="M49.71,19.466l6.929-4c1.914-1.105,2.57-3.551,1.461-5.465c-1.102-1.914-3.547-2.57-5.46-1.465l-6.93,4 c-1.914,1.105-2.57,3.551-1.461,5.464C45.351,19.915,47.796,20.571,49.71,19.466z">
                                                                    </path>
                                                                    <path fill="#000000"
                                                                        d="M56.639,48.535l-6.929-3.999c-1.914-1.105-4.355-0.449-5.461,1.464c-1.105,1.914-0.453,4.359,1.461,5.465 l6.93,4c1.913,1.105,4.358,0.449,5.464-1.465S58.553,49.641,56.639,48.535z">
                                                                    </path>
                                                                    <path fill="#000000"
                                                                        d="M37.53,0.307c-1.492-0.625-3.211-0.277-4.359,0.867L18.343,16.001H4c-2.211,0-4,1.789-4,4v24 C0,46.211,1.789,48,4,48h14.343l14.828,14.828C33.937,63.594,34.96,64,35.999,64c0.516,0,1.035-0.098,1.531-0.305 c1.496-0.617,2.469-2.078,2.469-3.695V4.001C39.999,2.384,39.026,0.924,37.53,0.307z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                @endif




                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">No data available for the
                                                selected filters.</td>
                                        </tr>
                                    @endforelse
                                </tbody>


                            </table>


                            <x-admin.success-alert></x-admin.success-alert>
                        </div>
                    </div>
                </main>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <x-admin.js></x-admin.js>

    {{-- Confirm Alert --}}
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this",
                showDenyButton: true,
                showConfirmButton: true,
                confirmButtonText: "Delete",
                icon: "warning",
                denyButtonText: `Don't delete`,
                customClass: {
                    confirmButton: 'confirm-button',
                    denyButton: 'cancel-button',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi penghapusan, submit form secara manual
                    document.getElementById("delete-form-" + productId).submit();
                }
            });
        }
    </script>

    <!-- Script untuk panggil nama -->
    <script>
        function panggilNama(historyId) {
            const customerCell = document.getElementById('customer-name-' + historyId);
            const customerName = customerCell.textContent.trim();
            const teks = "Atas nama " + customerName + ", Silahkan ambil pesanan di meja kasir";
            const suara = new SpeechSynthesisUtterance(teks);
            suara.lang = 'id-ID'; // Bahasa Indonesia
            suara.rate = 1; // Kecepatan bicara
            suara.pitch = 1; // Nada suara
            window.speechSynthesis.speak(suara);
        }
    </script>

    {{-- Script Print Struck --}}
    <script>
        function printReceipt(id) {
            fetch(`/admin/histories/print-struk/${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "{{ session('message', $title ?? 'Successfully Printed Struck') }}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Oops...",
                            text: data.message || "Failed to print struck!",
                            customClass: {
                                confirmButton: 'confirm-button',
                            }
                        });
                        // alert("Gagal cetak struk: " + data.message);
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Oops...",
                        text: "Failed to print struck!",
                    });
                });
        }
    </script>


    {{-- Script Download Excel --}}
    <script>
        document.getElementById('exportExcel').addEventListener('click', (e) => {
            e.preventDefault();

            const periode_awal = document.getElementById('periode_awal').value;
            const periode_akhir = document.getElementById('periode_akhir').value;

            if (!periode_awal || !periode_akhir) {
                alert('Please select the date range first');
                return;
            }

            const url = `/export-histories?periode_awal=${periode_awal}&periode_akhir=${periode_akhir}` +
                `?periode_awal=${periode_awal}&periode_akhir=${periode_akhir}`;
            window.location.href = url;
        });
    </script>

    {{-- Script Filter Data by Periode --}}
    <script>
        document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const periode_awal = document.getElementById('periode_awal').value;
            const periode_akhir = document.getElementById('periode_akhir').value;

            fetch(`/get-histories?periode_awal=${periode_awal}&periode_akhir=${periode_akhir}`)
            fetch(`/get-histories?periode_awal=${periode_awal}&periode_akhir=${periode_akhir}`)
                .then(response => response.json())
                .then(data => {
                    let table = $('#myTable').DataTable(); // Ambil instance DataTables
                    table.clear().destroy(); // Hancurkan terlebih dahulu agar bisa re-init

                    let tableBody = document.querySelector('#myTable tbody');
                    tableBody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data baru

                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach((history, index) => {
                            if (!history || typeof history !== 'object') return;

                            let id = history.id ?? 'N/A';
                            let casierName = history.casier_name ?? '-';
                            let customerName = history.customer_name ?? '-';
                            let createdAt = history.created_at ? new Date(history.created_at)
                                .toLocaleDateString() : '-';
                            let totalPrice = history.total_price ?? 0;
                            let paymentMethod = history.payment_method ?? '-';
                            let status = history.status ?? '-';

                            let row = `
                        <tr>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                <input type="checkbox" class="select-item" value="${id}">
                            </td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">#${index + 1}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${casierName}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${customerName}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${createdAt}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">Rp ${parseInt(totalPrice).toLocaleString()}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${paymentMethod}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                <span class="${status === 'Cancelled' ? 'text-red-700 font-extrabold' : ''}">
                                    ${status}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-3 mt-4">
                                    <a href="/histories/${id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                            <path fill="#6c80e4" fill-rule="evenodd"
                                                d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                        </svg>
                                    </a>
                                    <form id="delete-form-${id}" action="/histories/${id}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this history?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                            class="cursor-pointer hover:fill-red-700 transition duration-200"
                                            onclick="confirmDelete(${id})">
                                            <path fill="red"
                                                d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                        </svg>
                                    </form>
                                    <a href="javascript:void(0);"
                                        onclick="printReceipt(${id})"><svg width="42"
                                        height="42" viewBox="0 0 42 42" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                         d="M28.2851 23.8717H28.9156C30.1048 23.8717 30.6987 23.8717 31.0682 23.5022C31.4377 23.1328 31.4377 22.5388 31.4377 21.3496V20.0886C31.4377 17.7103 31.4377 16.5224 30.6987 15.7834C29.9598 15.0444 28.7719 15.0444 26.3935 15.0444H15.0442C12.6658 15.0444 11.4779 15.0444 10.739 15.7834C10 16.5224 10 17.7103 10 20.0886V22.6107C10 23.2046 10 23.5022 10.1841 23.6876C10.3695 23.8717 10.6671 23.8717 11.261 23.8717H13.1526"
                                            stroke="#9F6802" stroke-width="1.33333" />
                                        <path
                                         d="M13.7832 31.8239V21.3497C13.7832 20.1606 13.7832 19.5666 14.1527 19.1971C14.5222 18.8276 15.1161 18.8276 16.3053 18.8276H25.1326C26.3217 18.8276 26.9157 18.8276 27.2852 19.1971C27.6547 19.5666 27.6547 20.1606 27.6547 21.3497V31.8239C27.6547 32.2237 27.6547 32.4229 27.5235 32.5175C27.3924 32.6121 27.2032 32.549 26.8249 32.4229L24.091 31.5112C24.022 31.4806 23.9481 31.4627 23.8728 31.4582C23.7976 31.467 23.7245 31.4892 23.6572 31.5238L20.9535 32.6058C20.8806 32.644 20.8009 32.6676 20.7189 32.6751C20.637 32.6676 20.5573 32.644 20.4844 32.6058L17.7807 31.5238C17.6748 31.4809 17.6218 31.4608 17.5663 31.4582C17.5108 31.4557 17.4554 31.4746 17.3469 31.5112L14.613 32.4229C14.2347 32.549 14.0455 32.6121 13.9144 32.5175C13.7832 32.4229 13.7832 32.2237 13.7832 31.8239Z"
                                         stroke="#9F6802" stroke-width="1.33333" />
                                          <path d="M17.5664 23.8711H22.6106M17.5664 27.6542H23.8716"
                                           stroke="#9F6802" stroke-width="1.33333"
                                          stroke-linecap="round" />
                                        <path
                                        d="M27.6547 15.0442V14.5398C27.6547 12.3998 27.6547 11.3291 26.9901 10.6646C26.3255 10 25.2549 10 23.1149 10H18.323C16.183 10 15.1123 10 14.4478 10.6646C13.7832 11.3291 13.7832 12.3998 13.7832 14.5398V15.0442"
                                        stroke="#9F6802" stroke-width="1.33333" />
                                         </svg>
                                     </a>
                                </td>
                        </tr>
                    `;
                            tableBody.innerHTML += row;
                        });
                    } else {
                        tableBody.innerHTML =
                            `<tr><td colspan="10" class="text-center">No data available</td></tr>`;
                    }

                    // Inisialisasi ulang DataTables setelah isi baru dimasukkan
                    $('#myTable').DataTable();
                })
                .catch(error => {
                    console.error('Error:', error);
                    let tableBody = document.querySelector('#myTable tbody');
                    tableBody.innerHTML =
                        `<tr><td colspan="10" class="text-center text-red-600">Gagal memuat data</td></tr>`;
                });
        });
    </script>




    {{-- DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    {{-- BulkDelete script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedIds = new Set();
            const allIds = @json($histories->pluck('id')); // Laravel mengirimkan seluruh ID
            const selectAll = document.getElementById('select-all');
            const bulkDeleteButton = document.getElementById('bulkDeleteButton');

            // Inisialisasi DataTable
            const table = new DataTable('#myTable', {
                ordering: false
            });

            // Function BulkDelete display
            function updateBulkDeleteButton() {
                bulkDeleteButton.classList.toggle('hidden', selectedIds.size === 0);
            }

            // Saat draw (ganti halaman), sinkronisasi checkbox berdasarkan selectedIds
            table.on('draw', function() {
                document.querySelectorAll('.select-item').forEach(cb => {
                    cb.checked = selectedIds.has(cb.value);
                });

                const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(cb =>
                    cb.checked);
                selectAll.checked = allVisibleChecked;
            });

            // Checkbox individual
            document.querySelector('#myTable').addEventListener('change', function(e) {
                if (e.target.classList.contains('select-item')) {
                    const id = e.target.value;
                    if (e.target.checked) {
                        selectedIds.add(id);
                    } else {
                        selectedIds.delete(id);
                    }
                    updateBulkDeleteButton();
                    // Update selectAll state
                    const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(
                        cb => cb.checked);
                    selectAll.checked = allVisibleChecked;
                }
            });

            // Select All
            selectAll.addEventListener('change', function() {
                if (this.checked) {
                    allIds.forEach(id => selectedIds.add(String(id)));
                } else {
                    selectedIds.clear();
                }

                // Update visible checkboxes only
                document.querySelectorAll('.select-item').forEach(cb => {
                    cb.checked = selectAll.checked;
                });
                updateBulkDeleteButton();
            });

            // Bulk Delete
            bulkDeleteButton.addEventListener('click', function() {
                if (selectedIds.size === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No items selected',
                        text: 'Please select items to delete.',
                        customClass: {
                            confirmButton: 'confirm-button',
                        }
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'confirm-button',
                        cancelButton: 'cancel-button',
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch('{{ route('histories.bulkDelete') }}', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    ids: Array.from(selectedIds)
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed!',
                                        text: 'Deletion failed, try again.'
                                    });
                                }
                            })
                            .catch(error => console.error(error));
                    }
                });
            });
        });
    </script>
</body>

</html>
