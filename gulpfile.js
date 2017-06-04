const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
	mix.sass('app.scss')
		.webpack('app.js')
		.scripts(['FileSaver.js', 'spark-md5.js'])
		.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/build/fonts/bootstrap');
});

elixir(function(mix) {
	mix.version(['css/app.css', 'js/app.js', 'js/all.js', 'js/base2current.json']);
});
