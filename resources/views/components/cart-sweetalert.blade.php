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
            confirmButtonText: 'Oke'
        });
    @endif
</script>
