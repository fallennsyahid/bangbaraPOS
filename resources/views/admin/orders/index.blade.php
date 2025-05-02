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
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Orders</h1>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <!-- Tabel -->
                         {{-- Card Status --}}
                            <div class="px-4 pb-4">
                                <div class="border-2 border-red-600 bg-yellow-400 rounded-lg shadow-lg p-6">
                                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                        {{-- Pending --}}
                                        <div
                                            class="flex flex-col items-center justify-center gap-2 p-4 bg-yellow-600 rounded-lg shadow-md">
                                            <svg width="64px" height="64px" viewBox="0 0 1024 1024" class="icon"
                                                fill="#ffffff">
                                                <path
                                                    d="M511.9 183c-181.8 0-329.1 147.4-329.1 329.1s147.4 329.1 329.1 329.1c181.8 0 329.1-147.4 329.1-329.1S693.6 183 511.9 183z m0 585.2c-141.2 0-256-114.8-256-256s114.8-256 256-256 256 114.8 256 256-114.9 256-256 256z" />
                                                <path d="M548.6 365.7h-73.2v161.4l120.5 120.5 51.7-51.7-99-99z" />
                                            </svg>
                                            <span class="text-white text-lg font-semibold">50</span>
                                        </div>
                                        {{-- Processed --}}
                                        <div
                                            class="flex flex-col items-center justify-center gap-2 p-4 bg-yellow-600 rounded-lg shadow-md">
                                            <svg fill="#FFFFFF" width="64px" height="64px" viewBox="0 0 1920 1920">
                                                <path
                                                    d="M320.006 960.032c0 352.866 287.052 639.974 640.026 639.974 173.767 0 334.093-69.757 451.938-188.072l-211.928-211.912h480.019v479.981l-155.046-155.114C1377.649 1672.883 1177.24 1760 960.032 1760 518.814 1760 160 1401.134 160 960.032ZM959.968 160C1401.186 160 1760 518.866 1760 959.968h-160.006c0-352.866-287.052-639.974-640.026-639.974-173.767 0-334.093 69.757-451.938 188.072l211.928 211.912H239.94V239.997L394.985 395.03C542.351 247.117 742.76 160 959.968 160Z" />
                                            </svg>
                                            <span class="text-white text-lg font-semibold">50</span>
                                        </div>
                                        {{-- Completed --}}
                                        <div
                                            class="flex flex-col items-center justify-center gap-2 p-4 bg-yellow-600 rounded-lg shadow-md">
                                            <svg width="64px" height="64px" viewBox="0 0 1024 1024" fill="#ffffff"
                                                class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                stroke="#ffffff">
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
                                            <span class="text-white text-lg font-semibold">50</span>
                                        </div>
                                        {{-- Canceled --}}
                                        <div
                                            class="flex flex-col items-center justify-center gap-2 p-4 bg-yellow-600 rounded-lg shadow-md">
                                            <svg width="64px" height="64px" viewBox="0 0 512 512" fill="#ffffff">
                                                <path
                                                    d="M213.333333,1.42108547e-14 C331.15408,1.42108547e-14 426.666667,95.5125867 426.666667,213.333333 C426.666667,331.15408 331.15408,426.666667 213.333333,426.666667 C95.5125867,426.666667 4.26325641e-14,331.15408 4.26325641e-14,213.333333 C4.26325641e-14,95.5125867 95.5125867,1.42108547e-14 213.333333,1.42108547e-14 Z M42.6666667,213.333333 C42.6666667,307.589931 119.076736,384 213.333333,384 C252.77254,384 289.087204,370.622239 317.987133,348.156908 L78.5096363,108.679691 C56.044379,137.579595 42.6666667,173.894198 42.6666667,213.333333 Z M213.333333,42.6666667 C173.894198,42.6666667 137.579595,56.044379 108.679691,78.5096363 L348.156908,317.987133 C370.622239,289.087204 384,252.77254 384,213.333333 C384,119.076736 307.589931,42.6666667 213.333333,42.6666667 Z" />
                                            </svg>
                                            <span class="text-white text-lg font-semibold">50</span>
                                        </div>
                                    </div>
                                    {{-- Stats  --}}
                                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach (['Pending', 'Processed', 'Completed', 'Canceled'] as $status)
                                            <span class="flex items-center text-white text-sm font-medium">
                                                <svg width="32px" height="32px" viewBox="0 0 1024 1024"
                                                    class="icon" fill="#FFFFFF">
                                                    <path
                                                        d="M511.9 183c-181.8 0-329.1 147.4-329.1 329.1s147.4 329.1 329.1 329.1c181.8 0 329.1-147.4 329.1-329.1S693.6 183 511.9 183z m0 585.2c-141.2 0-256-114.8-256-256s114.8-256 256-256 256 114.8 256 256-114.9 256-256 256z" />
                                                    <path d="M548.6 365.7h-73.2v161.4l120.5 120.5 51.7-51.7-99-99z" />
                                                </svg>
                                                = {{ $status }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        <div class="flex flex-wrap justify-between w-full max-w-6xl mb-4 gap-4">
                            {{-- Export Button --}}
                            <div class="">
                                <a href="{{ route('orders.export') }}"
                                    class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg flex items-center">
                                    <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                        class="w-5 h-5 inline-block mr-2">
                                    Export
                                </a>
                            </div>
                           
                            {{-- Bulk Delete --}}
                            <div class="">
                                <button id="bulkDeleteButton" class="bg-red-700 text-white px-4 py-2 rounded-lg hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" class="inline-block">
                                        <path fill="red"
                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                    </svg>
                                    Delete Selected
                                </button>
                            </div>
                        </div>
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">

                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            <input type="checkbox" id="select-all" />
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Costumer</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Status</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Price</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Method</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Time</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-tbody" id="orderTableBody">
                                    @foreach ($orders as $index => $order)
                                        <tr class="hover:bg-thead" data-category="{{ $order->id }}">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950"> <input
                                                    type="checkbox" class="select-item" value="{{ $order->id }}">

                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                #{{ $index + 1 }}
                                            </td>
                                            <td id="customer-name-{{ $order->id }}" class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $order->customer_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                <h5 id="order-status-{{ $order->id }}"
                                                    class="
                                                    {{ $order->status == 'Pending' ? 'font-extrabold text-yellow-500' : '' }}">
                                                    {{ $order->status }}
                                                </h5>

                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                Rp {{ number_format($order->total_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $order->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">

                                                {{ $order->created_at->diffForHumans() }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="px-6 py-4 flex items-center gap-3 mt-4">

                                                <!-- Detail button -->
                                                <a href="{{ route('orders.show', $order->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>
                                                
                                                <!-- Update status button -->
                                                @if ($order->status !== 'Completed' && $order->status !== 'Cancelled')
                                                    <svg id="order-status-{{ $order->id }}" class="cursor-pointer"
                                                        xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24" onclick="openModal(this)"
                                                        data-id="{{ $order->id }}"
                                                        data-status="{{ $order->status }}">
                                                        <g fill="none" stroke="#28A745" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2">
                                                            <path
                                                                d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 2-2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                        </g>
                                                    </svg>
                                                @endif


                                                <!-- Delete button -->
                                                <form id="delete-form-{{ $order->id }}"
                                                    action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $order->id }})">
                                                        <path fill="red"
                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg>
                                                </form>
                                                
                                                <!-- {{-- ini untuk cetak struk --}} -->
                                                <a href="javascript:void(0)"
                                                        onclick="printReceipt({{ $order->id }})"><svg width="42"
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

                                                <!-- Button panggil pelanggan -->
                                                <button onclick="panggilNama({{ $order->id }})">🔊</button>


                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                                </tbody>
                            </table>


                            <!-- <x-admin.success-alert></x-admin.success-alert> -->
                        </div>
                    </div>
                </main>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- Open Modal Content -->
    <div id="modalConfirm"
        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white dark:bg-zinc-900 max-w-md">
            <div class="flex justify-end p-2">
                <button onclick="closeModal()" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">
                    Change Status for Order <span id="modalCurrentStatus"></span>:
                </h3>

                <input type="hidden" id="modalOrderId">
                <div id="modalStatusOptions" class="flex justify-center gap-2"></div>
            </div>
        </div>
    </div>

    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <x-admin.js></x-admin.js>
    <!-- Script untuk panggil nama -->
    <script>
         function panggilNama(orderId) {
            const customerCell = document.getElementById('customer-name-' + orderId);
            const customerName = customerCell.textContent.trim();
            const teks = "Atas nama " + customerName + ", Silahkan menuju ke kasir";
            const suara = new SpeechSynthesisUtterance(teks);
            suara.lang = 'id-ID'; // Bahasa Indonesia
            suara.rate = 1;       // Kecepatan bicara
            suara.pitch = 1;      // Nada suara
            window.speechSynthesis.speak(suara);
        }
    </script>

    <!--  Confirm Alert  -->
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this",
                showDenyButton: true,
                showConfirmButton: true,
                confirmButtonText: "Delete",
                icon: "warning",
                denyButtonText: "Don't delete",
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

    <!-- Open Modal Script -->
    <script type="text/javascript">
        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block'
            document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }

        // Close all modals when press ESC
        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none'
                })
            }
        };
    </script>

    <!-- Script action access -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil semua baris order
            const rows = document.querySelectorAll('#orderTableBody tr');

            rows.forEach(row => {
                const orderId = row.dataset.category;
                const statusEl = document.getElementById(`order-status-${orderId}`);
                const status = statusEl?.innerText?.trim();

                // Cek jika status adalah Pending, Cancelled, atau Completed
                if (['Pending', 'Cancelled', 'Completed'].includes(status)) {
                    // Nonaktifkan cetak struk
                    const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                    if (printBtn) {
                        printBtn.style.cursor = 'default';
                        printBtn.style.pointerEvents = 'none';
                        printBtn.style.opacity = '0.5';
                        printBtn.title = 'Tidak dapat mencetak struk pada status ini';
                    }

                    // Nonaktifkan tombol panggil
                    const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                    if (panggilBtn) {
                        panggilBtn.disabled = true;
                        panggilBtn.title = 'Tidak dapat memanggil pelanggan pada status ini';
                        panggilBtn.style.opacity = '0.5';
                        panggilBtn.style.cursor = 'not-allowed';
                    }
                }
            });
        });
    </script>


    <!-- {{-- DataTables --}} -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <!-- {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}} -->

    <!-- Update realtime table -->
    <script>
        let lastOrderTimestamp = null;
        let orderId = null;
        const selectedIds = new Set();

        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            disableActionsBasedOnStatus();
            applyOrderActionAccess();



            // Inisialisasi DataTable (jika belum)
            if (!$.fn.DataTable.isDataTable("#myTable")) {
                $('#myTable').DataTable({
                    "columnDefs": [{
                        "targets": 0,
                    }],
                    "ordering": false,
                    "responsive": true,
                    "pageLength": 10
                });
            }


            // Checkbox select-all dan select-item
            const allIds = @json($orders->pluck('id')); // Ganti jika ID diambil dari controller
            const selectAll = document.getElementById('select-all');
            const bulkDeleteButton = document.getElementById('bulkDeleteButton');

            const table = $('#myTable').DataTable();

            // Function display delete selected
            function updateBulkDeleteButton() {
                bulkDeleteButton.classList.toggle('hidden', selectedIds.size === 0);
            }

            // Sync checkbox saat pagination berubah
            table.on('draw', function() {
                document.querySelectorAll('.select-item').forEach(cb => {
                    cb.checked = selectedIds.has(cb.value);
                });

                const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(cb =>
                    cb.checked);
                if (selectAll) selectAll.checked = allVisibleChecked;
            });

            // Event untuk select-item
            document.querySelector('#myTable').addEventListener('change', function(e) {
                if (e.target.classList.contains('select-item')) {
                    const id = e.target.value;
                    if (e.target.checked) {
                        selectedIds.add(id);
                    } else {
                        selectedIds.delete(id);
                    }
                    updateBulkDeleteButton();

                    const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(
                        cb => cb.checked);
                    if (selectAll) selectAll.checked = allVisibleChecked;
                }
            });

            // Event untuk select-all
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    if (this.checked) {
                        allIds.forEach(id => selectedIds.add(String(id)));
                    } else {
                        selectedIds.clear();
                    }

                    document.querySelectorAll('.select-item').forEach(cb => {
                        cb.checked = selectAll.checked;
                    });
                    updateBulkDeleteButton();
                });
            }

            // Event untuk tombol Bulk Delete
            if (bulkDeleteButton) {
                bulkDeleteButton.addEventListener('click', function() {
                    if (selectedIds.size === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No items selected',
                            text: 'Please select items to delete.',
                            showConfirmButton: true,
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
                            fetch('{{ route('orders.bulkDelete') }}', {
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
            }
        });

        // Cek order baru setiap 5 detik
        setInterval(checkNewOrders, 2000);


        // Fungsi untuk check new orders
        function checkNewOrders() {
            $.ajax({
                url: "/orders/latest",
                type: "GET",
                success: function(data) {
                    if (data && (!lastOrderTimestamp || new Date(data.created_at) > new Date(
                            lastOrderTimestamp))) {
                        lastOrderTimestamp = data.created_at;
                        updateTable();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching orders:", error);
                }
            });
        }

        // Fungsi untuk update table
        function updateTable() {
            $.ajax({
                url: "/admin/orders",
                type: "GET",
                success: function(data) {
                    let newTbody = $(data).find("tbody").html();

                    if ($.fn.DataTable.isDataTable("#myTable")) {
                        $('#myTable').DataTable().clear().destroy();
                    }

                    $("#orderTableBody").html(newTbody);

                    $('#myTable').DataTable({
                        "columnDefs": [{
                            "targets": 0,
                        }],
                        "ordering": false,
                        "responsive": true,
                        "pageLength": 10
                    });

                    $(window).trigger('resize');
                    disableActionsBasedOnStatus();
                    applyOrderActionAccess();
                    initializeEventListeners();
                },
                error: function(xhr, status, error) {
                    console.error("Error updating order table:", error);
                }
            });
        }

        // Fungsi untuk disable button
        function disableActionsBasedOnStatus() {
        const rows = document.querySelectorAll('#orderTableBody tr');

        rows.forEach(row => {
            const orderId = row.dataset.category;
            const statusEl = document.getElementById(`order-status-${orderId}`);
            const status = statusEl?.innerText?.trim();

            if (['Pending', 'Cancelled', 'Completed'].includes(status)) {
                const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                if (printBtn) {
                    printBtn.style.cursor = 'default';
                    printBtn.style.pointerEvents = 'none';
                    printBtn.style.opacity = '0.5';
                    printBtn.title = 'Tidak dapat mencetak struk pada status ini';
                }

                const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                if (panggilBtn) {
                    panggilBtn.disabled = true;
                    panggilBtn.title = 'Tidak dapat memanggil pelanggan pada status ini';
                    panggilBtn.style.opacity = '0.5';
                    panggilBtn.style.cursor = 'not-allowed';
                }
            }
        });
    }

        // Realtime action access
        function applyOrderActionAccess() {
         const rows = document.querySelectorAll('#orderTableBody tr');

            rows.forEach(row => {
                const orderId = row.dataset.category;
                const statusEl = document.getElementById(`order-status-${orderId}`);
                const status = statusEl?.innerText?.trim();

                if (['Pending', 'Cancelled', 'Completed'].includes(status)) {
                    const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                    if (printBtn) {
                        printBtn.style.cursor = 'default';
                        printBtn.style.pointerEvents = 'none';
                        printBtn.style.opacity = '0.5';
                        printBtn.title = 'Tidak dapat mencetak struk pada status ini';
                    }

                    const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                    if (panggilBtn) {
                        panggilBtn.disabled = true;
                        panggilBtn.title = 'Tidak dapat memanggil pelanggan pada status ini';
                        panggilBtn.style.opacity = '0.5';
                        panggilBtn.style.cursor = 'not-allowed';
                    }

                } else {
                    // Aktifkan kembali jika status bukan yang di-lock
                    const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                    if (printBtn) {
                        printBtn.style.cursor = 'pointer';
                        printBtn.style.pointerEvents = 'auto';
                        printBtn.style.opacity = '1';
                        printBtn.title = '';
                    }

                    const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                    if (panggilBtn) {
                        panggilBtn.disabled = false;
                        panggilBtn.style.opacity = '1';
                        panggilBtn.style.cursor = 'pointer';
                        panggilBtn.title = '';
                    }
                }
            });
        }


        // fungsi untuk inisialiasi
        function initializeEventListeners() {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    confirmDelete(orderId);
                });
            });

            document.querySelectorAll('.open-modal-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    openModal(this);
                });
            });

            // Tambahkan event listener untuk tombol cetak struk
            document.querySelectorAll('.print-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    printReceipt(orderId);
                });
            });
        }

        function confirmDelete(orderId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this",
                showDenyButton: true,
                showConfirmButton: true,
                confirmButtonText: "Delete",
                icon: "warning",
                denyButtonText: "Don't delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById(`delete-form-${orderId}`);
                    if (form) form.submit();
                }
            });
        }

        function openModal(element) {
            let orderId = element.getAttribute("data-id");
            let currentStatus = element.getAttribute("data-status");

            document.getElementById("modalOrderId").value = orderId;
            document.getElementById("modalCurrentStatus").textContent = currentStatus;

            let availableStatuses = [];
            if (currentStatus === "Pending") {
                availableStatuses = ["Processed", "Cancelled"];
            } else if (currentStatus === "Processed") {
                availableStatuses = ["Completed", "Cancelled"];
            }

            let statusContainer = document.getElementById("modalStatusOptions");
            statusContainer.innerHTML = "";

            availableStatuses.forEach(status => {
                let button = document.createElement("button");
                button.textContent = status;
                button.className = "px-4 py-2 rounded-md text-white mx-2 " +
                    (status === "Processed" ? "bg-yellow-800 hover:bg-yellow-700" :
                        status === "Cancelled" ? "bg-red-700 hover:bg-red-600" :
                        "bg-green-500 hover:bg-green-400");

                button.onclick = function() {
                    updateStatus(status, orderId);
                };

                statusContainer.appendChild(button);
            });

            document.getElementById("modalConfirm").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById('modalConfirm').classList.add("hidden");
        }

        function updateStatus(currentStatus, orderId) {
            fetch(`/admin/orders/${orderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: currentStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#fcd34d',
                        });

                        let statusElement = document.getElementById(`order-status-${orderId}`);
                        if (statusElement) {
                            const statusClasses = {
                                'Processed': 'text-black',
                                'Pending': 'text-yellow-300 font-extrabold',
                                'Cancelled': 'text-black',
                                'Completed': 'text-black',
                            };

                            statusElement.className = `text-center ${statusClasses[currentStatus] || ''}`;
                            statusElement.innerText = currentStatus;
                        }

                        document.querySelector(`[data-id="${orderId}"]`).setAttribute("data-status", currentStatus);
                        updateOrderStatus(orderId, currentStatus);

                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Status update failed',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                    closeModal();
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        function updateOrderStatus(orderId, newStatus) {
            const statusElement = document.getElementById(`order-status-${orderId}`);
            if (statusElement) {
                statusElement.setAttribute('data-status', newStatus);
                statusElement.style.display = 'block'; // pastikan tetap tampil

                // Update class dan isi teks juga bisa ditaruh di sini (opsional)
                const statusClasses = {
                    'Processed': 'text-black',
                    'Pending': 'text-yellow-300 font-extrabold',
                    'Cancelled': 'text-black',
                    'Completed': 'text-black',
                };
                statusElement.className = `text-center ${statusClasses[newStatus] || ''}`;
                statusElement.innerText = newStatus;
            }
            applyOrderActionAccess();

        }

        function printReceipt(id) {
            fetch(`/admin/orders/print-struk/${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
</body>

</html>
