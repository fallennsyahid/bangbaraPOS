<script>
    // Update Cart Quantity Badge
    function updateCartQuantity() {
        fetch("{{ route('cart.quantity') }}")
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('cart-quantity-badge');
                badge.textContent = data.quantity;
            })
            .catch(error => console.error('Error fetching cart quantity:', error));
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', updateCartQuantity);

    function updateCartQuantityDekstop() {
        fetch("{{ route('cart.quantity.desktop') }}")
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('cart-quantity-badge-desktop');
                badge.textContent = data.quantity;
            })
            .catch(error => console.error('Error fetching cart quantity:', error));
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', updateCartQuantityDekstop);
</script>
