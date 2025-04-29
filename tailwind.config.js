const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    darkMode: "class", // or 'media' or false
    theme: {
        fontFamily: {
            sans: ["cairo", "sans-serif"],
            body: [
                "Inter",
                "ui-sans-serif",
                "system-ui",
                "-apple-system",
                "system-ui",
                "Segoe UI",
                "Roboto",
                "Helvetica Neue",
                "Arial",
                "Noto Sans",
                "sans-serif",
                "Apple Color Emoji",
                "Segoe UI Emoji",
                "Segoe UI Symbol",
                "Noto Color Emoji",
            ],
            sans: [
                "Inter",
                "ui-sans-serif",
                "system-ui",
                "-apple-system",
                "system-ui",
                "Segoe UI",
                "Roboto",
                "Helvetica Neue",
                "Arial",
                "Noto Sans",
                "sans-serif",
                "Apple Color Emoji",
                "Segoe UI Emoji",
                "Segoe UI Symbol",
                "Noto Color Emoji",
            ],
            // poppins: ['Poppins', 'sans-serif'],
            euphoria: ["Euphoria Script", 'cursive'],
            cookie: ["Cookie", "cursive"],
        },

        extend: {
            colors: {
                light: "var(--light)",
                dark: "var(--dark)",
                darker: "var(--darker)",
                kuning: "#FFC600",
                text: "#722F37",
                price: "#4E2A2A",
                prime: "#E3E3E3",
                thead: "#D5D5D5",
                tbody: "#CCCCCC",
                ijal: "#00000",
                primary: "#FFC600",
                text: "#722F37",
                price: "#4E2A2A",
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["checked", "disabled"],
            opacity: ["dark"],
            overflow: ["hover"],
        },
    },
    plugins: [],
};
