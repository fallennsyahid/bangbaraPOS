// Navbar Fixed
window.onscroll = function () {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;
    const toTop = document.querySelector('#to-top');

    if (window.scrollY > fixedNav) {
        header.classList.add('navbar-fixed');
        toTop.classList.remove('hidden');
        toTop.classList.add('flex');
    } else {
        header.classList.remove('navbar-fixed');
        toTop.classList.remove('flex');
        toTop.classList.add('hidden');
    }
};

// Hamburger
const hamburger = document.querySelector('#hamburger');
const navMenu = document.querySelector('#nav-menu');

hamburger.addEventListener('click', function () {
    hamburger.classList.toggle('hamburger-active');
    navMenu.classList.toggle('hidden');
});

// Out Hamburger
window.addEventListener('click', function (e) {
    if (e.target != hamburger && e.target != navMenu) {
        hamburger.classList.remove('hamburger-active');
        navMenu.classList.add('hidden');
    }
});


// Menu Active
const menuLinks = document.querySelectorAll('.menu-link');

menuLinks.forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah aksi default link

        // Hapus kelas active dari semua link
        menuLinks.forEach(l => l.classList.remove('active'));

        // Tambahkan kelas active ke link yang diklik
        this.classList.add('active');
    });
});


// Menu Slide
function changeSlide(index) {
    const sliderContent = document.getElementById("slider-content");
    const slideWidth = sliderContent.clientWidth / 3; // Menghitung lebar satu slide
    sliderContent.style.transform = `translateX(-${index * slideWidth}px)`; // Menggeser sesuai index
}

// POPUP
const itemDetailModal = document.getElementById('item-detail-modal');
const itemDetailButtons = document.querySelectorAll('.item-detail-button');

itemDetailButtons.forEach((btn) => {
    btn.addEventListener("click", function (e) {
        e.preventDefault();

        // Ambil data dari atribut `data-*`
        const productName = this.getAttribute("data-name");
        const productImage = this.getAttribute("data-image");
        const productDescription = this.getAttribute("data-description");
        const productPrice = this.getAttribute("data-price");

        // Set data ke dalam modal
        document.getElementById("modal-product-image").src = productImage;
        document.getElementById("modal-product-name").innerText = productName;
        document.getElementById("modal-product-description").innerText = productDescription;
        document.getElementById("modal-product-price").innerText = productPrice;

        // Tampilkan modal
        itemDetailModal.style.display = 'flex';
    });
});

// Tutup modal saat tombol close diklik
document.querySelector('.close-icon').onclick = (e) => {
    itemDetailModal.style.display = 'none';
    e.preventDefault();
};

// Tutup modal saat klik di luar modal
window.onclick = (e) => {
    if (e.target === itemDetailModal) {
        itemDetailModal.style.display = 'none';
    }
};

// Rating
const stars = document.querySelectorAll('input[name="rating"]');
const labels = document.querySelectorAll('#star label i');

stars.forEach((star, index) => {
    star.addEventListener("change", function () {
        // Reset semua bintang ke bentuk kosong dan abu-abu
        labels.forEach((label, i) => {
            label.classList.remove('text-yellow-500', 'fas');
            label.classList.add('far'); // Kembalikan ke bintang kosong abu-abu
        });

        // Update warna bintang yang dipilih dan sebelumnya
        for (let i = 0; i <= index; i++) {
            const label = labels[i];
            label.classList.remove('far');
            label.classList.add('fas',
                'text-yellow-500'); // Ubah ke bintang penuh kuning
        }
    });
});
