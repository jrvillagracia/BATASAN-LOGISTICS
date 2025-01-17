/** @type {import('tailwindcss').Config} */
export default {
  darkMode: false,
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        'welcome-color': '#163172'
      }
    },
  },
  plugins: [],
}

