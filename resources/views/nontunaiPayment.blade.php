<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BangbaraPOS - Payment Non Tunai</title>
    {{-- CSS --}}
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('asset-view/css/extra.css') }}">
    {{-- Link Web --}}
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">
    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data x-init="$refs.loading.classList.add('hidden')" class="header-img min-h-screen flex flex-col items-center justify-center">
    <x-loading-animation></x-loading-animation>
    <div class="container mx-auto my-6 p-6 bg-yellow-500 border border-red-600 rounded-lg shadow-lg font-sans max-w-lg">
        <h2 class="text-center text-black text-2xl font-bold mb-6">Silakan Selesaikan Pembayaran</h2>
        @foreach ($products as $product)
            <div class="mb-6 p-4 border border-red-600 rounded-lg bg-yellow-300">
                <h4 class="text-black text-lg font-semibold mb-2">{{ $product['nama_menu'] }}</h4>
                <p class="text-black mb-1">Jumlah:
                    <span class="font-bold">
                        {{ $product['quantity'] }}
                    </span>
                </p>
                <p class="text-black mb-1">Harga:
                    <span class="font-bold">
                        Rp{{ number_format($product['price'], 0, ',', '.') }}
                    </span>
                </p>
                <p class="text-black mb-1">Kategori:
                    <span class="font-bold">
                        {{ $product['category'] }}
                    </span>
                </p>
                <p class="text-black mb-1 flex gap-2 items-center">Gambar Menu:
                    <img src="{{ Storage::url($product['gambar_menu']) }}" alt="Gambar Product"
                        class="w-20 h-20 object-cover rounded-md border border-red-600" />
                </p>
            </div>
        @endforeach

        <button id="pay-button"
            class="w-full py-3 bg-red-600 text-white text-lg font-bold rounded-lg uppercase hover:bg-red-700 transition duration-300">
            Bayar Sekarang
        </button>
        <pre id="result-json" class="hidden"></pre>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snap_token }}', {
                onSuccess: function(result) {
                    localStorage.setItem("midtrans_payment_success", "true");
                    window.location.href = "{{ route('payment.success') }}";
                },
                onPending: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
</body>

</html>
