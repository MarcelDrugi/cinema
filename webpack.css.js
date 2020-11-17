const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css').combine([
	    'resources/less/discount/index.less',
	    'resources/less/movie/index.less',
	],
	'public/css/main.css'
);
