<script>
    // Quantity Badge Update for Mobile
    function updateCartQuantity() {
        fetch("{{ route('cart.quantity') }}")
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('cart-quantity-badge');
                badge.textContent = data.quantity;
            })
            .catch(error => console.error('Error fetching cart quantity:', error));
    }

    // Quantity Badge Update for Desktop
    function updateCartQuantityDekstop() {
        fetch("{{ route('cart.quantity.desktop') }}")
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('cart-quantity-badge-desktop');
                badge.textContent = data.quantity;
            })
            .catch(error => console.error('Error fetching cart quantity:', error));
    }

    // Jalankan sesuai kondisi
    document.addEventListener('DOMContentLoaded', function() {
        const isDesktop = window.matchMedia("(min-width: 1024px)").matches;

        if (isDesktop) {
            updateCartQuantityDekstop();
        } else {
            updateCartQuantity();
        }
    });
</script>
