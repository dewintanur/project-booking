const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .react() // Jika kamu menggunakan React
   .sass('resources/sass/app.scss', 'public/css');
