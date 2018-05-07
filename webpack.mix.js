const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js').sourceMaps();
mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.copy('node_modules/open-iconic/svg', 'public/i/svg');
if (mix.inProduction()) {
	mix.version(['public/css/app.css', 'public/js/app.js', 'public/js/base2current.json']);
}
