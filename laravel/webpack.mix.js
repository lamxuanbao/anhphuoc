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
    .sass('resources/sass/app.scss', 'public/css/app.css')

/*  storefont  */
mix.sass('resources/storefont/sass/app.scss', 'public/css/storefont/layout.css')
    .sass('resources/storefont/sass/partials/header.scss', 'public/css/storefont//partials')
    .sass('resources/storefont/sass/partials/header_search.scss', 'public/css/storefont//partials')
    .sass('resources/storefont/sass/pages/area.scss', 'public/css/storefont/pages')
    .sass('resources/storefont/sass/pages/detail.scss', 'public/css/storefont/pages')
/*  end storefont  */

/*  admin  */
// mix.sass('resources/admin/sass/style.scss', 'public/css/admin')
//     .sass('resources/admin/sass/pages/login/login-1.scss', 'public/css/admin/pages/login')
/*  end admin  */

mix.options({
    processCssUrls: false
})
