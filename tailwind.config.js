const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                label: {
                    default: "#999",
                    primary: "#337ab7",
                    success: "#5cb85c",
                    info: "#5bc0de",
                    warning: "#f0ad4e",
                },
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
