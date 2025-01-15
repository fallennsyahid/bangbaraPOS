    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Success",
                icon: "success",
                text: "{{ session('success') }}",
                draggable: true,
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'confirm-button'
                }
            });
        @endif
    </script>
