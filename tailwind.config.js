const colors = require('tailwindcss/colors')

module.exports = {
  // mode:'jit',
  content: [
    './templates/template_tailwind/*.php', // './public/**/*.{html,js}'
    './templates/template_tailwind/assets/css/**/*.css',
  ],
  // darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Vazir', 'Samim', 'tahoma', 'Arial']
      },
      colors: {
        'tolidatColor': '#ff710d',
        gray: colors.neutral,
        orange: colors.orange,
      },
      backgroundImage: {
        'home-pattern-01': "url('/templates/template_tailwind/assets/image/bg-01.jpg')",
        'home-pattern-02': "url('/templates/template_tailwind/assets/image/bg-02.jpg')",
        'home-pattern-03': "url('/templates/template_tailwind/assets/image/bg-03.jpg')",
        'home-pattern-04': "url('/templates/template_tailwind/assets/image/bg-04.jpg')"
      }
    },
    container: {
      screens: {
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
      }
    }
  },
  // variants: {
  //   extend: {
  //     ringWidth: ['focus-visible'],
  //     ringColor: ['focus-visible'],
  //     ringOffsetWidth: ['focus-visible'],
  //     ringOffsetColor: ['focus-visible']
  //   },
  // },
  plugins: [
    require('tailwindcss-rtl'),
  ],
  experimental: {
    applyComplexClasses: true
  }
}