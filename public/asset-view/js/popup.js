document.addEventListener("DOMContentLoaded", function () {
    const itemDetailModal = document.querySelector("#item-detail-modal");
    const itemDetailButtons = document.querySelectorAll(".item-detail-button");
    const closePopupBtn = document.querySelector(".close-icon");
    const addToCartButton = document.querySelector("#add-to-cart-modal");
    const quantityInput = document.querySelector("#modal-quantity");
    const quantityButtons = document.querySelector('#quantity-button');
    const decreaseQtyButton = document.querySelector("#decrease-qty");
    const increaseQtyButton = document.querySelector("#increase-qty");
    const pilihanSaus = document.getElementById("pilihan-saus");
    const modalContainer = document.querySelector("[name='modal-container']");

    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Buat elemen pilihan Hot/Ice
    const pilihanHotIce = document.createElement("div");
    pilihanHotIce.id = "pilihan-hot-ice";
    pilihanHotIce.className = "hidden";
    pilihanHotIce.innerHTML = `
        <h3 class="text-center text-base font-semibold text-gray-800 mb-2">Pilih Penyajian</h3>
        <div class="sauce flex justify-center gap-2 flex-wrap">
            <input type="radio" name="hot_ice" id="hot" value="hot" class="hidden peer/hot">
            <label for="hot"
                class="py-1 px-3 border border-yellow-400 bg-yellow-200 cursor-pointer transition-all duration-200 ease-out shadow-sm text-sm text-gray-800 rounded 
                peer-checked/hot:bg-[#e7b800] peer-checked/hot:text-white peer-checked/hot:shadow-[0_0_10px_4px_rgba(211,47,47,0.4)] peer-checked/hot:scale-[1.02]
                hover:shadow-md active:scale-95">
                Hot
            </label>

            <input type="radio" name="hot_ice" id="ice" value="ice" class="hidden peer/ice">
            <label for="ice"
                class="py-1 px-3 border border-yellow-400 bg-yellow-200 cursor-pointer transition-all duration-200 ease-out shadow-sm text-sm text-gray-800 rounded 
                peer-checked/ice:bg-[#e7b800] peer-checked/ice:text-white peer-checked/ice:shadow-[0_0_10px_4px_rgba(211,47,47,0.4)] peer-checked/ice:scale-[1.02]
                hover:shadow-md active:scale-95">
                Ice
            </label>
        </div>
    `;

    modalContainer.insertBefore(pilihanHotIce, quantityButtons);

    itemDetailButtons.forEach((btn) => {
        btn.onclick = (e) => {
            e.preventDefault();

            const productCard = btn.closest(".product-card");
            const productId = btn.getAttribute("data-product-id");
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

            // Tentukan apakah ini kategori makanan atau minuman
            let isMakanan = productCard.closest("#slider-content").children[0].contains(productCard);
            let isMinuman = productCard.closest("#slider-content").children[1].contains(productCard);
            let isAirMineral = productName.toLowerCase().includes("air mineral");

            if (isMakanan) {
                pilihanSaus.classList.remove("hidden");
                pilihanHotIce.classList.add("hidden");
            } else if (isMinuman) {
                if (isAirMineral) {
                    pilihanHotIce.classList.add("hidden");
                } else {
                    pilihanHotIce.classList.remove("hidden");
                }
                pilihanSaus.classList.add("hidden");
            } else {
                pilihanSaus.classList.add("hidden");
                pilihanHotIce.classList.add("hidden");
            }

            itemDetailModal.classList.remove("hidden");
            itemDetailModal.classList.add("flex");
        };
    });

    closePopupBtn.onclick = (e) => {
        e.preventDefault();
        closeModal();
    };

    itemDetailModal.onclick = (e) => {
        if (e.target === itemDetailModal) {
            closeModal();
        }
    };

    function closeModal() {
        itemDetailModal.classList.add("hidden");
        itemDetailModal.classList.remove("flex");
    }

    increaseQtyButton.onclick = () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    };

    decreaseQtyButton.onclick = () => {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) quantityInput.value = currentQty - 1;
    };

    addToCartButton.onclick = function () {
        let productId = itemDetailModal.querySelector("input[name='product_id']").value;
        let quantity = quantityInput.value;
        let url = this.dataset.url;
        let selectedSauce = document.querySelector("input[name='sauce']:checked") ? document.querySelector("input[name='sauce']:checked").value : "";
        let selectedHotIce = document.querySelector("input[name='hot_ice']:checked") ? document.querySelector("input[name='hot_ice']:checked").value : "";

        // if (!productId) {
        //     Swal.fire({
        //         icon: "error",
        //         title: "Oops...",
        //         text: "Produk tidak valid! ID tidak ditemukan.",
        //     });
        //     return;
        // }

        // Validasi pilihan sauce jika pilihan saus ditampilkan
        if (!pilihanSaus.classList.contains("hidden") && !selectedSauce) {
            Swal.fire({
                icon: "warning",
                title: "Pilih Saus",
                text: "Silakan pilih saus terlebih dahulu sebelum melanjutkan!",
                confirmButtonText: "OK",
                confirmButtonColor: "#CC0000",
            });
            return;
        }

        // Validasi pilihan hot/ice jika opsi ini ditampilkan
        if (!pilihanHotIce.classList.contains("hidden") && !selectedHotIce) {
            Swal.fire({
                icon: "warning",
                title: "Pilih Penyajian",
                text: "Silakan pilih penyajian terlebih dahulu sebelum melanjutkan!",
                confirmButtonText: "OK",
                confirmButtonColor: "#CC0000",
            });
            return;
        }

        let form = document.createElement("form");
        form.method = "POST";
        form.action = url;

        let csrfInput = document.createElement("input");
        csrfInput.type = "hidden";
        csrfInput.name = "_token";
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);

        let productInput = document.createElement("input");
        productInput.type = "hidden";
        productInput.name = "product_id";
        productInput.value = productId;
        form.appendChild(productInput);

        let quantityInputField = document.createElement("input");
        quantityInputField.type = "hidden";
        quantityInputField.name = "quantity";
        quantityInputField.value = quantity;
        form.appendChild(quantityInputField);

        if (!pilihanSaus.classList.contains("hidden")) {
            let sauceInputField = document.createElement("input");
            sauceInputField.type = "hidden";
            sauceInputField.name = "sauce";
            sauceInputField.value = selectedSauce;
            form.appendChild(sauceInputField);
        }

        if (!pilihanHotIce.classList.contains("hidden")) {
            let hotIceInputField = document.createElement("input");
            hotIceInputField.type = "hidden";
            hotIceInputField.name = "hot_ice";
            hotIceInputField.value = selectedHotIce;
            form.appendChild(hotIceInputField);
        }

        document.body.appendChild(form);
        form.submit();
    };
});
