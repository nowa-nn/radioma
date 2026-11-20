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
          blue: '#0093CB',      // фирменный циан-голубой цвет логотипа
          'blue-dark': '#007EAF',
          'blue-deep': '#006B95',
          'blue-light': '#EBF6FB',
          navy: '#0B253A',      // глубокий морской технический цвет
          'navy-dark': '#071826',
          yellow: '#F5B800',    // технический желтый цвет кейса и акцентов из брошюры
          'yellow-hover': '#DF9B00',
        },
        brand: {
          DEFAULT: '#0093CB',
          hover: '#007EAF',
          dark: '#006B95',
          light: '#EBF6FB',
          border: '#B3E1F3'
        }
      }
    },
  },
  plugins: [],
}
