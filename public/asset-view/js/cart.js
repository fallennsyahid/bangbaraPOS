document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (event) {
        if (event.target.closest(".increase, .decrease")) {
            console.log("Button Clicked!"); // Cek apakah event terdeteksi
            let button = event.target.closest(".increase, .decrease");
            let id = button.getAttribute("data-id");
            let inputField = document.getElementById(`cart-item-${id}`);
            let totalPriceField = document.getElementById(
                `cart-item-${id}-total-price`
            );
            let cartItemDiv = inputField.closest(".group");
            let newQuantity = parseInt(inputField.value);

            if (button.classList.contains("increase")) newQuantity++;
            else if (button.classList.contains("decrease")) newQuantity--;

            console.log(`Updating quantity for item ${id} to ${newQuantity}`);

            fetch(`/cart/update/${id}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    quantity: newQuantity,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log("Response received:", data); // Cek response dari server
                    if (data.remove) {
                        cartItemDiv.remove();
                    } else {
                        inputField.value = data.quantity;
                        totalPriceField.textContent = `Rp ${data.total.toLocaleString(
                            "id-ID",
                            { minimumFractionDigits: 2 }
                        )}`;
                    }

                    // Update total items & total harga
                    document.getElementById(
                        "cart-total-items"
                    ).textContent = `${data.totalItems} Items`;
                    document.getElementById(
                        "cart-total-price"
                    ).textContent = `Rp ${data.totalPrice.toLocaleString(
                        "id-ID",
                        { minimumFractionDigits: 2 }
                    )}`;
                })
                .catch((error) => console.error("Fetch error:", error)); // Tangani error dari Fetch API
        }
    });

    // Validasi Input
    const checkoutButton = document.getElementById('checkoutButton');
    const requiredFields = [
        document.getElementById('customer_name'),
        document.getElementById('customer_phone'),
        document.getElementById('serve_option'),
        document.getElementById('metodePembayaran')
    ];

    function validateForm() {
        let allFilled = true;
        requiredFields.forEach(field => {
            if (!field.value || field.value === "-") {
                allFilled = false;
            }
        });

        if (allFilled) {
            checkoutButton.disabled = false;
            checkoutButton.classList.remove(
                'bg-red-400', 'cursor-not-allowed'
            );
            checkoutButton.classList.add(
                'bg-red-600', 'cursor-pointer',
                'hover:bg-red-700', 'hover:scale-105',
                'active:bg-red-800', 'active:scale-100'
            );
        } else {
            checkoutButton.disabled = true;
            checkoutButton.classList.remove(
                'bg-red-600', 'cursor-pointer',
                'hover:bg-red-700', 'hover:scale-105',
                'active:bg-red-800', 'active:scale-100'
            );
            checkoutButton.classList.add(
                'bg-red-400', 'cursor-not-allowed'
            );
        }
    }

    // Cek saat input berubah
    requiredFields.forEach(field => {
        field.addEventListener('input', validateForm);
        field.addEventListener('change', validateForm);
    });

    // Cek pertama kali
    validateForm();

    // PAYMENT METHOD
    // const metodePembayaran = document.querySelector("#metodePembayaran");
    // const buktiPembayaran = document.getElementById("bukti-pembayaran");
    // const qrCode = document.querySelector("#qrcode");
    // const imagePayment = document.querySelector("#imagePayment");
    // const paymentPhoto = document.querySelector("#payment_photo");

    // metodePembayaran.addEventListener("change", function () {
    //     if (this.value === "nonTunai") {
    //         qrCode.classList.remove("hidden");
    //         qrCode.classList.add("flex");
    //         buktiPembayaran.classList.remove("hidden");
    //         buktiPembayaran.classList.add("block");
    //         paymentPhoto.setAttribute("required", "required");
    //     } else {
    //         qrCode.classList.add("hidden");
    //         qrCode.classList.remove("flex");
    //         buktiPembayaran.classList.add("hidden");
    //         buktiPembayaran.classList.remove("block");
    //         paymentPhoto.removeAttribute("required");
    //     }
    // });

    // imagePayment.addEventListener("click", () => {
    //     qrCode.classList.add("hidden");
    // });

    // function updateFileName(input) {
    //     const fileName = input.files.length > 0 ? input.files[0].name : "Tidak ada file yang dipilih";
    //     document.getElementById("file-name").textContent = fileName;
    // }
});
