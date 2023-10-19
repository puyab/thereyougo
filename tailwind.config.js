import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/* @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/awcodes/filament-curator/resources/**/*.blade.php',
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
    "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",
    // "./app/Forms/*.php",
    // "./app/Tables/*.php",
  ],

  theme: {
    extend: {
      fontFamily: {
        'crimson-pro': ['Crimson Pro', 'serif'],
        'inter': ['Inter', 'serif']
      }
    },
  },

  plugins: [forms, typography],
};
