/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    
  ],
  theme: {
    extend: {
    colors:{
      dark: '#10242c',
      orange: '#fb923c',
      green: '#65A30D',
      approved: "#4CAF50",
      expired: "#F44336" ,
      expiring: "#FFC107",
      pending: "#2196F3",
      claimed: "#4CAF50",
      requested: "#2196F3"
    },
    fontFamily: {
      'custom-font': ['Montserrat'],     
    },
  },
},
safelist: [
  'text-approved',
  'text-expired',
  'text-expiring',
  'text-pending',
  'text-claimed',
  'text-requested',
  'bg-requested',
  'bg-claimed'

  // Add more classes as needed
],
  plugins: [],
}

