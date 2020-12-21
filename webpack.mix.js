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

mix.js('resources/js/app.js', 'public/js');

mix.scripts([
        'resources/js/order/index.js',
		'resources/js/movie/index.js',
		'resources/js/discount/index.js',
		'resources/js/screening/index.js',
		'resources/js/modifypricing/index.js',
		'resources/js/layouts/base.js',
		'resources/js/homepage/index.js',
		'resources/js/repertoire/index.js',
		'resources/js/pricing/index.js',
		'resources/js/profile/index.js',
		'resources/js/auth/register.js',
		'resources/js/information/index.js',
	],
	'public/js/main.js'
);
