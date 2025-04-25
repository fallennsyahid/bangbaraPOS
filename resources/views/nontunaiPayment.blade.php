<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Non-Tunai</title>
</head>

<body>
    <div class="container">
        <h2>Silakan Selesaikan Pembayaran</h2>
        @foreach ($products as $product)
            <div>
                <h4>{{ $product['nama_menu'] }}</h4>
                <p>Qty: {{ $product['quantity'] }}</p>
                <p>Harga: Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
                <p>Kategori: {{ $product['category'] }}</p>
                <img src="{{ Storage::url($product['gambar_menu']) }}" class="w-20 h-20 object-cover rounded-md"
                    alt="Gambar Product" />
            </div>
        @endforeach

        <button id="pay-button" class="bg-blue-700 rounded-xl p-4">Bayar Sekarang</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $order->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    console.log("Payment success:", result);
                    window.location.href = "{{ route('index') }}"; // Ganti sesuai rute halaman tujuan
                },
                // Optional
                onPending: function(result) {
                    console.log("Payment pending:", result);
                    window.location.href = "{{ route('index') }}"; // Bisa juga redirect di sini kalau mau
                },
                onError: function(result) {
                    console.log("Payment error:", result);
                    alert("Pembayaran gagal, silakan coba lagi.");
                },
            });
        };
    </script>
</body>

</html>
