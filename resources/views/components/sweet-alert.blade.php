<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

<script>
    // document.addEventListener("DOMContentLoaded", function() {
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: @json(session('success')),
            showConfirmButton: false,
            timer: 1500,
        });
    @endif

    @if (session('checkout_success'))
        Swal.fire({
            title: "Yeay! Pesananmu sudah terkirim",
            text: @json(session('checkout_success')),
            icon: "success",
            confirmButtonText: "OK",
            confirmButtonColor: "#CC0000"
        });
    @endif

    if (localStorage.getItem("midtrans_payment_success") === "true") {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Pembayaran kamu berhasil!',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false,
        });

        // Hapus flag agar tidak muncul terus
        localStorage.removeItem("midtrans_payment_success");
    }

    // @if (session('checkout_success') === 'tunai')
    //     Swal.fire({
    //         title: "Yeay! Pesananmu sudah terkirim",
    //         text: "Pesanan berhasil dibuat, silakan menuju kasir untuk pembayaran",
    //         icon: "success",
    //         confirmButtonText: "OK",
    //         confirmButtonColor: "#CC0000"
    //     });
    // @elseif (session('checkout_success') === 'nonTunai')
    //     Swal.fire({
    //         title: "Yeay! Pesananmu sudah terkirim",
    //         text: "Chef kita lagi semangat masak buat kamu. Tunggu bentar lagi ya~",
    //         icon: "success",
    //         confirmButtonText: "OK",
    //         confirmButtonColor: "#CC0000"
    //     });
    // @endif
    // });
</script>
