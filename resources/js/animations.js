import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

// About Section Animations Start
// Animasi dari kiri untuk gambar steak desktop (About)
gsap.fromTo(".about-img", {
    x: -100,
    opacity: 0
}, {
    x: 0,
    opacity: 1, // sesuaikan dengan opacity akhir kamu di HTML
    duration: 1.2,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#about",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse",
    }
});

// Animasi dari kiri untuk gambar steak mobile (About)
gsap.fromTo(".mobile-about-img", {
    opacity: 0,
    scale: 0.95,
    filter: "blur(8px)"
}, {
    opacity: 0.4,
    scale: 1,
    filter: "blur(0px)",
    duration: 1.5,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#about",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse"
    }
});

// Animasi dari atas untuk teks
gsap.fromTo(".about-title", {
    y: -100,
    opacity: 0
}, {
    y: 0,
    opacity: 1,
    duration: 1.2,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#about",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse",
    }
});

// Animasi dari bawah untuk teks
gsap.fromTo(".about-text", {
    y: 100,
    opacity: 0
}, {
    y: 0,
    opacity: 1,
    duration: 1.2,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#about",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse",
    }
});
// About Section Animations End 

// Contact Section Animations Start
ScrollTrigger.matchMedia({
    // Mobile (max-width: 767px)
    "(max-width: 767px)": function () {
        gsap.fromTo(".form-contact", {
            y: 100,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#contact",
                start: "top 80%",
                end: "bottom top",
                toggleActions: "play reverse play reverse"
            }
        });
    },

    // Desktop (min-width: 768px)
    "(min-width: 768px)": function () {
        gsap.fromTo(".form-contact", {
            x: -100,
            opacity: 0
        }, {
            x: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#contact",
                start: "top 80%",
                end: "bottom top",
                toggleActions: "play reverse play reverse"
            }
        });
    }
});

// Animasi untuk gambar dari kanan (review)
gsap.fromTo(".contact-img", {
    x: 100,
    opacity: 0
}, {
    x: 0,
    opacity: 1,
    duration: 1.2,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#contact",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse",
    }
});

// Animasi untuk contact title
gsap.fromTo(".contact-title", {
    y: -100,
    opacity: 0
}, {
    y: 0,
    opacity: 1,
    duration: 1.2,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#contact",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse",
    }
});
// Contact Section Animations End

// Ulasan Section Animations Start
// Animasi dari atas untuk ulasan title
gsap.fromTo(".ulasan-title", {
    y: -100,
    opacity: 0
}, {
    y: 0,
    opacity: 1,
    duration: 1.2,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#ulasan",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse",
    }
});

// Animasi dari bawah untuk slider ulasan
gsap.fromTo(".ulasan-slide", {
    y: 100,
    opacity: 0
}, {
    y: 0,
    opacity: 1,
    duration: 1.2,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#ulasan",
        start: "top 80%",
        end: "bottom top",
        toggleActions: "play reverse play reverse",
    }
});
// Ulasan Section Animations End

