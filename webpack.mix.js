let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/pages/guest.js','public/js/pages/guest.js')
   .js('resources/assets/js/pages/admin.js','public/js/pages/admin.js')
   .js('resources/assets/js/pages/login.js','public/js/pages/login.js')

   .sass('resources/assets/sass/app.scss', 'public/css')

   module: {
     loaders: [
       { test: /\.css$/, loader: "css-loader" }
     ]
   }
