<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: {!! json_encode(session('success')) !!},
            showConfirmButton: false,
<<<<<<< HEAD
            timer: 1700,
=======
            timer: 1500,
>>>>>>> ba63282505d71938bef16983cb1dcd840224129c
        });
    @endif
</script>

<script>
    @if (session('checkout_success') === 'tunai')
        Swal.fire({
            title: "Yeay! Pesananmu sudah terkirim",
            text: "Pesanan berhasil dibuat, silakan menuju kasir untuk pembayaran",
            icon: "success",
            // imageUrl: "{{ asset('asset-view/assets/svg/success.svg') }}",
            // imageWidth: 400,
            // imageHeight: 200,
            // imageAlt: "Success Logo",
            confirmButtonText: "OK",
            confirmButtonColor: "#CC0000",
        });
    @elseif (session('checkout_success') === 'nonTunai')
        Swal.fire({
            title: "Yeay! Pesananmu sudah terkirim",
            text: "Chef kita lagi semangat masak buat kamu. Tunggu bentar lagi ya~",
            icon: "success",
            confirmButtonText: "OK",
            confirmButtonColor: "#CC0000",
        });
    @endif
</script>
