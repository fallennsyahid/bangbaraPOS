document.addEventListener("DOMContentLoaded", function () {
    const itemDetailModal = document.querySelector("#item-detail-modal");
    const itemDetailButtons = document.querySelectorAll(".item-detail-button");
    const closeButton = document.querySelector(".close-icon");
    const addToCartButton = document.querySelector("#add-to-cart-modal");
    const quantityInput = document.querySelector("#modal-quantity");
    const decreaseQtyButton = document.querySelector("#decrease-qty");
    const increaseQtyButton = document.querySelector("#increase-qty");

    // Pastikan CSRF token tersedia
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Event saat tombol "View More" diklik
    itemDetailButtons.forEach((btn) => {
        btn.onclick = (e) => {
            e.preventDefault();

            const productCard = btn.closest(".product-card");
            const productId = productCard.querySelector("input[name='product_id']").value;
            const productImage = productCard.querySelector("img").src;
            const productName = productCard.querySelector("p").innerText;
            const productDescription = productCard.querySelector("h6").innerText;

            if (!productId) {
                alert("Produk tidak ditemukan!");
                return;
            }

            // Update isi modal
            itemDetailModal.querySelector("img").src = productImage;
            itemDetailModal.querySelector("h1").innerText = productName;
            itemDetailModal.querySelector("p").innerText = productDescription;

            // Set product ID di input hidden dalam modal
            document.querySelector("#modal-product-id").value = productId;

            // Tampilkan modal
            itemDetailModal.classList.remove("hidden");
            itemDetailModal.classList.add("flex");
        };
    });

    // Tutup modal saat tombol close diklik
    closeButton.onclick = (e) => {
        e.preventDefault();
        closeModal()
    };
    itemDetailModal.onclick = (e) => {
        if (e.target === itemDetailModal) closeModal();
    };

    function closeModal() {
        itemDetailModal.classList.add("hidden");
        itemDetailModal.classList.remove("flex");
    }

    // Fitur tambah/kurang quantity dalam modal
    increaseQtyButton.onclick = () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    };

    decreaseQtyButton.onclick = () => {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) quantityInput.value = currentQty - 1;
    };

    // Event untuk menambahkan produk ke keranjang
    addToCartButton.onclick = function () {
        let productId = itemDetailModal.querySelector("input[name='product_id']").value;
        let quantity = quantityInput.value;
        let url = this.dataset.url;

        // Cek apakah productId dan URL benar
        console.log("Product ID:", productId);
        console.log("Quantity:", quantity);
        console.log("URL:", url);

        if (!productId) {
            alert("Produk tidak valid! ID tidak ditemukan.");
            return;
        }

        // Buat form untuk dikirim ke Laravel
        let form = document.createElement("form");
        form.method = "POST";
        form.action = url;

        // Tambahkan CSRF token
        let csrfInput = document.createElement("input");
        csrfInput.type = "hidden";
        csrfInput.name = "_token";
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);

        // Tambahkan product_id
        let productInput = document.createElement("input");
        productInput.type = "hidden";
        productInput.name = "product_id";
        productInput.value = productId;
        form.appendChild(productInput);

        // Tambahkan quantity
        let quantityInputField = document.createElement("input");
        quantityInputField.type = "hidden";
        quantityInputField.name = "quantity";
        quantityInputField.value = quantity;
        form.appendChild(quantityInputField);

        document.body.appendChild(form);
        form.submit();
    };
});