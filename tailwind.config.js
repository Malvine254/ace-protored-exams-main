import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#EB001B",
                secondary: "#1C085D",
                alt: "#FDCA40",
                bg: "#E6E8E6",
                black: "#080708",
            },
            container: {
                center: true,
                padding: "16px",
            },
        },
    },

    plugins: [forms, typography],
};
