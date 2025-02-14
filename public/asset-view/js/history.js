// History Menu Active
const historyLinks = document.querySelectorAll(".history-menu");

historyLinks.forEach((history) => {
    history.addEventListener("click", function (e) {
        e.preventDefault();

        // Hapus kelas 'active' dari semua tombol
        historyLinks.forEach((h) => h.classList.remove("active"));

        // Tambahkan kelas 'active' ke tombol yang diklik
        this.classList.add("active");
    });
});

function showContent(type) {
    const slider = document.getElementById("slider");
    const btnSemua = document.getElementById("btn-semua");
    const btnProses = document.getElementById("btn-proses");

    if (type === "semua") {
        slider.style.transform = "translateX(0)";
        btnSemua.classList.add("active");
        btnProses.classList.remove("active");
    } else if (type === "proses") {
        slider.style.transform = "translateX(-50%)";
        btnProses.classList.add("active");
        btnSemua.classList.remove("active");
    }
}


// Navbar Fixed
window.onscroll = function () {
    const navbarHis = document.querySelector('#nav-history');
    const fixedHisNav = navbarHis.offsetTop;

    if (window.scrollY > fixedHisNav) {
        navbarHis.classList.add('navbar-history');
    } else {
        navbarHis.classList.remove('navbar-history');
    }
}