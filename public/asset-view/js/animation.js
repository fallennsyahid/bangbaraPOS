document.addEventListener("DOMContentLoaded", function () {
    // Debugging untuk memastikan file ini ter-load
    console.log("GSAP Loaded!");

    // Register plugin ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);
    gsap.registerPlugin(matchMedia);

    // Animasikan gambar desktop (.about-img)
    gsap.fromTo(".about-img",
        { x: -100, opacity: 0 },
        {
            x: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#about",
                start: "top 80%",
                end: "bottom top",
                toggleActions: "play none none none",
                // markers: true // aktifkan untuk debugging posisi trigger
            }
        }
    );

    // Animasikan gambar background mobile (.mobile-about-img)
    gsap.fromTo(".mobile-about-img",
        { opacity: 0, scale: 0.95 },
        {
            opacity: 0.4,
            scale: 1,
            duration: 1.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#about",
                start: "top 90%",
                end: "bottom top",
                toggleActions: "play none none none",
                // markers: true // aktifkan jika mau lihat garis trigger
            }
        }
    );

    // Animasikan judul dan teks konten
    gsap.fromTo(".about-title",
        { y: 50, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#about",
                start: "top 75%",
                toggleActions: "play none none none"
            }
        }
    );

    gsap.fromTo(".about-text",
        { y: 50, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            duration: 1,
            delay: 0.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#about",
                start: "top 75%",
                toggleActions: "play none none none"
            }
        }
    );

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
});
