document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".increase, .decrease").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let inputField = document.getElementById(`cart-item-${id}`);
            let totalPriceField = document.getElementById(`cart-item-${id}-total-price`);
            let basePrice = parseFloat(totalPriceField.getAttribute("data-price"));
            let newQuantity = parseInt(inputField.value);

            if (this.classList.contains("increase")) {
                newQuantity++;
            } else if (this.classList.contains("decrease") && newQuantity > 1) {
                newQuantity--;
            }

            fetch(`/cart/update/${id}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
                .then(response => response.json())
                .then(data => {
                    inputField.value = data.quantity;
                    totalPriceField.textContent = `Rp ${data.total.toLocaleString("id-ID", { minimumFractionDigits: 2 })}`;
                });
        });
    });
});
