/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
      },
      colors: {
        radioma: {
          blue: '#0084C7',      // фирменный циан-синий с логотипа и брошюры
          'blue-dark': '#00669E',
          'blue-light': '#E6F4FA',
          navy: '#0B253A',      // глубокий морской технический цвет
          'navy-dark': '#071826',
          yellow: '#F5B800',    // технический желтый цвет кейса и акцентов из брошюры
          'yellow-hover': '#DF9B00',
        }
      }
    },
  },
  plugins: [],
}
