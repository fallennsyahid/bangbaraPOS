<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: @json(session('success')),
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    @if (session('checkout_success') === 'tunai')
        Swal.fire({
            title: "Yeay! Pesananmu sudah terkirim",
            text: "Pesanan berhasil dibuat, silakan menuju kasir untuk pembayaran",
            icon: "success",
            confirmButtonText: "OK",
            confirmButtonColor: "#CC0000"
        });
    @elseif (session('checkout_success') === 'nonTunai')
        Swal.fire({
            title: "Yeay! Pesananmu sudah terkirim",
            text: "Chef kita lagi semangat masak buat kamu. Tunggu bentar lagi ya~",
            icon: "success",
            confirmButtonText: "OK",
            confirmButtonColor: "#CC0000"
        });
    @endif
</script>
