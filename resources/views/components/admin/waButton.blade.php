<form action="{{ route('store.toggleStatus') }}" method="POST" id="status-form">
    @csrf
    <p class="p-1 font-semibold text-black">Change Status:</p>
    <button onclick="event.preventDefault(); confirmChange()"
        class="{{ \App\Models\Store::first()->status == 1 ? 'bg-red-700 hover:bg-red-800' : 'bg-green-500 hover:bg-green-600' }} rounded-lg text-white px-4 py-2 transition-all ease-in-out duration-300">
        {{ optional(\App\Models\Store::first())->status ? 'Close Store' : 'Open Store' }}
    </button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmChange() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will change the store status and customer access.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#b91c1c',
            cancelButtonColor: '#facc15',
            confirmButtonText: 'Yes, change',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('status-form').submit();
            }
        });
    }
</script>

<script>
    @if (session('success'))
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Successfully change status",
            showConfirmButton: false,
            timer: 1500
        });
    @endif
</script>
