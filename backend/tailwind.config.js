import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                display: ['"Cormorant Garamond"', ...defaultTheme.fontFamily.serif],
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#fafafa',
                    100: '#f5f5f5',
                    200: '#e5e5e5',
                    300: '#d4d4d4',
                    400: '#a1a1aa',
                    500: '#18181b',
                    600: '#27272a',
                    700: '#3f3f46',
                    800: '#27272a',
                    900: '#18181b',
                },
                surface: '#ffffff',
                border: '#e5e5e5',
            },
        },
    },

    plugins: [forms],
};