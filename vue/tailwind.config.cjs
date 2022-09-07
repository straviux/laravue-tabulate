/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",],
  theme: {
    extend: {
        backgroundImage: {
        'footer': "url('src/assets/img/footer_bg.gif')",
        },
    },

  },
  plugins: [require('@tailwindcss/typography'),require("daisyui"),require('@tailwindcss/line-clamp'),],
  daisyui: {
    styled: true,
    themes: true,
    base: true,
    utils: true,
    logs: true,
    rtl: false,
    prefix: "",
    darkTheme: "dark",
  },
}
