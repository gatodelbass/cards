const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {

        borderWidth: {
            DEFAULT: '1px',
            '0': '0',
            '1': '1px',
            '2': '2px',
           '3': '3px',
            '4': '4px',
           '6': '6px',
           '8': '8px',
          },


        

        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
         
              spacing: {
                '78': '19.4rem',
              },

              animation: {
                'ping1': 'ping 0.8s cubic-bezier(0, 0, 0.2, 1) ',
                'ping2': 'ping 1s cubic-bezier(0, 0, 0.2, 1) infinite',
                'ping3': 'ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite',
                'ping4': 'ping 1.8s cubic-bezier(0, 0, 0.2, 1) infinite',
                'ping5': 'ping 2s cubic-bezier(0, 0, 0.2, 1) infinite',         
                'ping10': 'ping 5s cubic-bezier(0, 0, 0.2, 1) infinite',
        
               
               }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
