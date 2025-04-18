// Navbar Fixed
window.onscroll = function () {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;

    if (window.scrollY > fixedNav) {
        header.classList.add('navbar-fixed');
    } else {
        header.classList.remove('navbar-fixed');
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
const sliderContent = document.getElementById("slider-content");
// let currentIndex = 0;
let currentIndex = parseInt(localStorage.getItem('sliderIndex')) || 0;

menuLinks.forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        // Ambil index dari data-index
        const index = parseInt(this.dataset.index);

        // Update index dan slide
        currentIndex = index;
        updateSlide();

        // Atur ulang kelas active
        menuLinks.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
    });
});

// Fungsi menggeser slide
function updateSlide() {
    const slideWidth = document.getElementById("slider").clientWidth;
    sliderContent.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

    localStorage.setItem('sliderIndex', currentIndex);
}

// Responsif
window.addEventListener("resize", updateSlide);

function scrollToActiveTab() {
    const activeTab = document.querySelector('.menu-link.active');
    if (activeTab) {
        activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }
}

function setActiveTab(index) {
    menuLinks.forEach(l => l.classList.remove('active'));
    if (menuLinks[index]) {
        menuLinks[index].classList.add('active');
    }
}

document.addEventListener("DOMContentLoaded", () => {
    updateSlide();
    setActiveTab(currentIndex);
    scrollToActiveTab();
});


// Rating
const stars = document.querySelectorAll('input[name="rating"]');
const labels = document.querySelectorAll('#star label i');

stars.forEach((star, index) => {
    star.addEventListener("change", function () {
        // Reset semua bintang ke bentuk kosong dan abu-abu
        labels.forEach((label, i) => {
            label.classList.remove('star-icon', 'fas');
            label.classList.add('far'); // Kembalikan ke bintang kosong abu-abu
        });

        // Update warna bintang yang dipilih dan sebelumnya
        for (let i = 0; i <= index; i++) {
            const label = labels[i];
            label.classList.remove('far');
            label.classList.add('fas',
                'star-icon'); // Ubah ke bintang penuh kuning
        }
    });
});
