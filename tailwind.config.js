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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary-teal': '#afd4cc',
                'primary-blue': '#706f9a',
                'primary-purple': '#74a5bc',
                'hover-teal': '#7a9d96',
                'hover-blue': '#6c8bb0',
                'hover-purple': '#77517b',
                'primary-brown': '#cfa385',
                'hover-brown': '#bf8985',
                'primary-fuchsia': '#a17486',
                'hover-fuchsia': '#796580',
                'primary-cyan': '#515771',
                'hover-cyan': '#2f4858',
            },
        },
    },

    plugins: [forms],
};
