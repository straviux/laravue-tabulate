/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors")
module.exports = {
  content: ["./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",],
  theme: {
    extend: {
        backgroundImage: {
        'footer': "url('src/assets/img/footer_bg.gif')",
        },
        colors: {
            ...colors,
            background: "#efe8e0",
            color_1: "#70367c",
            color_2: "#95cfd5",
            color_3: "#fd7e50",
            black: "#310e3a",
            debug: colors.red[400]
        }
    },


  },
  safelist: [
    {
        pattern: /ring-(color_1|color_2|color_3)/
    },
    {
        pattern: /bg-(color_1|color_2|color_3)/
    },
  ],
  plugins: [
    require('@tailwindcss/typography'),
    require("daisyui"),
    require('@tailwindcss/line-clamp'),
  ],
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
