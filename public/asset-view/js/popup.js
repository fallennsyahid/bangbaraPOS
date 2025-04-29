document.addEventListener("DOMContentLoaded", function () {
    const itemDetailModal = document.querySelector("#item-detail-modal");
    const itemDetailButtons = document.querySelectorAll(".item-detail-button");
    const closePopupBtn = document.querySelector(".close-icon");
    const addToCartButton = document.querySelector("#add-to-cart-modal");
    const quantityInput = document.querySelector("#modal-quantity");
    const quantityButtons = document.querySelector("#quantity-button");
    const decreaseQtyButton = document.querySelector("#decrease-qty");
    const increaseQtyButton = document.querySelector("#increase-qty");
    const pilihanSaus = document.getElementById("pilihan-saus");
    const modalContainer = document.querySelector("[name='modal-container']");
    const targetLatitude = parseFloat(
        document.getElementById("targetLatitude").value
    ); // Ambil koordinat dari hidden field
    const targetLongitude = parseFloat(
        document.getElementById("targetLongitude").value
    ); // Ambil koordinat dari hidden field
    const toleranceMeters = 500; // Toleransi jarak

    let csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    // Elemen pilihan Hot/Ice
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

    // Fungsi untuk toggle tombol add to cart
    function updateAddToCartButtonState() {
        const sauceVisible = !pilihanSaus.classList.contains("hidden");
        const hotIceVisible = !pilihanHotIce.classList.contains("hidden");

        const sauceChecked = document.querySelector(
            "input[name='sauce']:checked"
        );
        const hotIceChecked = document.querySelector(
            "input[name='hot_ice']:checked"
        );

        let enable = true;

        if (sauceVisible && !sauceChecked) enable = false;
        if (hotIceVisible && !hotIceChecked) enable = false;

        addToCartButton.disabled = !enable;
        addToCartButton.classList.toggle("opacity-50", !enable);
        addToCartButton.classList.toggle("cursor-not-allowed", !enable);
    }

    // Observe tampilan saus/hot-ice
    const observer = new MutationObserver(updateAddToCartButtonState);
    observer.observe(pilihanSaus, {
        attributes: true,
        attributeFilter: ["class"],
    });
    observer.observe(pilihanHotIce, {
        attributes: true,
        attributeFilter: ["class"],
    });

    // Saat radio berubah
    document.addEventListener("change", function (e) {
        if (e.target.name === "sauce" || e.target.name === "hot_ice") {
            updateAddToCartButtonState();
        }
    });

    itemDetailButtons.forEach((btn) => {
        btn.onclick = (e) => {
            e.preventDefault();

            const productCard = btn.closest(".product-card");
            const productId = btn.getAttribute("data-product-id");
            const productImage = productCard.querySelector("img").src;
            const productName = productCard.querySelector("p").innerText;
            const productDescription =
                productCard.querySelector("h6").innerText;

            if (!productId) {
                alert("Produk tidak ditemukan!");
                return;
            }

            itemDetailModal.querySelector("img").src = productImage;
            itemDetailModal.querySelector("h1").innerText = productName;
            itemDetailModal.querySelector("p").innerText = productDescription;
            document.querySelector("#modal-product-id").value = productId;

            let isMakanan = productCard
                .closest("#slider-content")
                .children[0].contains(productCard);
            let isMinuman = productCard
                .closest("#slider-content")
                .children[1].contains(productCard);
            let isAirMineral = /air\s*mineral/i.test(productName);

            if (isMakanan) {
                pilihanSaus.classList.remove("hidden");
                pilihanHotIce.classList.add("hidden");
            } else if (isMinuman) {
                pilihanHotIce.classList.remove("hidden");

                if (isAirMineral) {
                    pilihanHotIce.querySelector(
                        "#hot"
                    ).nextElementSibling.innerText = "Biasa";
                    pilihanHotIce.querySelector("#hot").value = "biasa";
                } else {
                    pilihanHotIce.querySelector(
                        "#hot"
                    ).nextElementSibling.innerText = "Hot";
                    pilihanHotIce.querySelector("#hot").value = "hot";
                }

                pilihanSaus.classList.add("hidden");
            } else {
                pilihanSaus.classList.add("hidden");
                pilihanHotIce.classList.add("hidden");
            }

            // Reset radio
            document
                .querySelectorAll("input[name='sauce']")
                .forEach((i) => (i.checked = false));
            document
                .querySelectorAll("input[name='hot_ice']")
                .forEach((i) => (i.checked = false));

            itemDetailModal.classList.remove("hidden");
            itemDetailModal.classList.add("flex");

            setTimeout(updateAddToCartButtonState, 100);
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
        let productId = itemDetailModal.querySelector(
            "input[name='product_id']"
        ).value;
        let quantity = quantityInput.value;
        let url = this.dataset.url;
        let selectedSauce =
            document.querySelector("input[name='sauce']:checked")?.value || "";
        let selectedHotIce =
            document.querySelector("input[name='hot_ice']:checked")?.value ||
            "";

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    // Hitung jarak
                    const distance = getDistanceFromLatLonInMeters(
                        userLat,
                        userLng,
                        targetLatitude,
                        targetLongitude
                    );

                    if (distance <= toleranceMeters) {
                        // Submit form jika dalam jangkauan
                        let form = document.createElement("form");
                        form.method = "POST";
                        form.action = url;

                        let csrfInput = document.createElement("input");
                        csrfInput.type = "hidden";
                        csrfInput.name = "_token";
                        csrfInput.value = document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content");
                        form.appendChild(csrfInput);

                        let productInput = document.createElement("input");
                        productInput.type = "hidden";
                        productInput.name = "product_id";
                        productInput.value = productId;
                        form.appendChild(productInput);

                        let quantityInput = document.createElement("input");
                        quantityInput.type = "hidden";
                        quantityInput.name = "quantity";
                        quantityInput.value = quantity;
                        form.appendChild(quantityInput);

                        if (selectedSauce) {
                            let sauceInput = document.createElement("input");
                            sauceInput.type = "hidden";
                            sauceInput.name = "sauce";
                            sauceInput.value = selectedSauce;
                            form.appendChild(sauceInput);
                        }

                        if (selectedHotIce) {
                            let hotIceInput = document.createElement("input");
                            hotIceInput.type = "hidden";
                            hotIceInput.name = "hot_ice";
                            hotIceInput.value = selectedHotIce;
                            form.appendChild(hotIceInput);
                        }

                        // Tambahkan latitude dan longitude user
                        let latitudeInput = document.createElement("input");
                        latitudeInput.type = "hidden";
                        latitudeInput.name = "latitude";
                        latitudeInput.value = userLat;
                        form.appendChild(latitudeInput);

                        let longitudeInput = document.createElement("input");
                        longitudeInput.type = "hidden";
                        longitudeInput.name = "longitude";
                        longitudeInput.value = userLng;
                        form.appendChild(longitudeInput);

                        document.body.appendChild(form);
                        form.submit();
                    } else {
                        alert(
                            "Anda harus berada di area kerja untuk melakukan pemesanan!"
                        );
                    }
                },
                function (error) {
                    alert(
                        "Gagal mendapatkan lokasi. Pastikan izin lokasi sudah aktif."
                    );
                }
            );
        } else {
            alert("Browser tidak mendukung geolocation.");
        }
    };

    // Fungsi bantu hitung jarak antar koordinat (dalam meter)
    function getDistanceFromLatLonInMeters(lat1, lon1, lat2, lon2) {
        const R = 6371000; // Radius bumi dalam meter
        const dLat = deg2rad(lat2 - lat1);
        const dLon = deg2rad(lon2 - lon1);
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) *
                Math.cos(deg2rad(lat2)) *
                Math.sin(dLon / 2) *
                Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const d = R * c;
        return d;
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }
});
