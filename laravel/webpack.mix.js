const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .copy('node_modules/font-awesome/fonts/', 'public/fonts')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/sites/layout.scss', 'public/css/sites')
    .sass('resources/sass/sites/header.scss', 'public/css/sites')
    .sass('resources/sass/sites/header_search.scss', 'public/css/sites')
    .sass('resources/sass/sites/area.scss', 'public/css/sites')
    .options({
        processCssUrls: false
    });
