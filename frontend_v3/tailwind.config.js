export default {
  plugins: [require('daisyui')],
  daisyui: {
    themes: ['light'],
  },
    theme: {
      extend: {},
    },
  purge: ["./index.html",'./src/**/*.{svelte,js,ts}'], //for unused css
  variants: {
    extend: {},
  },
  darkmode: false, // or 'media' or 'class'
}