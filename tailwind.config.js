/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'text': '#333333',
        'background': '#f4f4f4',
        'primary': '#047F03',
        'secondary': '#BF8800',
        'accent': '#006300',
       },       
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
  ],
}

