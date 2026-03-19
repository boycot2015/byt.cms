/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  purge: {
    content: [
      './index.html',
      './src/**/*.{vue,js,ts,jsx,tsx}'
    ],
    options: {
      safelist: function () {
        return {
          standard: ['lg:grid-cols-5', 'lg:grid-cols-6'] // 这里添加可能动态生成的类名
        };
      }
    },
    mode: 'layers'
  },
  darkMode: 'class',
  theme: {
    extend: {},
  },
  plugins: [],
}