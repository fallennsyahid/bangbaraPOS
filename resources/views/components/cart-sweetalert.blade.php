<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: {!! json_encode(session('error')) !!},
            confirmButtonText: "OK",
            confirmButtonColor: "#CC0000",
        });
    @endif

    @if ($errors->has('customer_phone'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ $errors->first('customer_phone') }}',
            confirmButtonText: 'Oke',
            confirmButtonColor: "#CC0000",
        });
    @endif

    document.getElementById('checkoutButton').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Cek Pesanan Anda',
            text: 'Apakah Anda yakin ingin melanjutkan checkout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Checkout',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#CC0000',
            cancelButtonColor: '#FFD700'
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
</script>
