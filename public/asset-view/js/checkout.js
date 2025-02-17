function checkout() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    if (cart.length === 0) {
        alert("Keranjang masih kosong!");
        return;
    }

    let name = document.getElementById("name").value;
    let phone = document.getElementById("no-telp").value;
    let paymentMethod = document.getElementById("metodePembayaran").value;
    let paymentPhoto = document.getElementById("payment-photo").files[0]; // Ambil file foto pembayaran

    if (!name || !phone || paymentMethod === "-") {
        alert("Harap lengkapi semua data sebelum checkout.");
        return;
    }

    let formData = new FormData();
    formData.append("customer_name", name);
    formData.append("customer_phone", phone);
    formData.append("payment_method", paymentMethod);
    formData.append("payment_photo", paymentPhoto);

    cart.forEach((item, index) => {
        formData.append(`products[${index}][product_id]`, item.id);
        formData.append(`products[${index}][quantity]`, item.quantity);
        formData.append(`products[${index}][total_price]`, item.price * item.quantity);
    });

    // Kirim data ke server dengan fetch
    fetch("/checkout", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Pesanan berhasil disimpan!");

                // Simpan ke LocalStorage sebagai history
                let history = JSON.parse(localStorage.getItem("history")) || [];
                history.push({
                    order_id: data.order_id,
                    customer_name: name,
                    customer_phone: phone,
                    payment_method: paymentMethod,
                    payment_photo: URL.createObjectURL(paymentPhoto),
                    items: cart
                });

                localStorage.setItem("history", JSON.stringify(history));

                // Kosongkan keranjang
                localStorage.removeItem("cart");
                loadCart();
            } else {
                alert("Terjadi kesalahan, coba lagi.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Gagal menyimpan pesanan.");
        });
}
