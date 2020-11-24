const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css');

mix.less('resources/less/discount/index.less', '../resources/css/discount')
	    .less('resources/less/movie/index.less', '../resources/css/movie')
		.less('resources/less/layouts/base.less', '../resources/css/layouts').combine([
	    'resources/css/discount/index.css',
		'resources/css/movie/index.css',
	    'resources/css/layouts/base.css',
	],
	'public/css/main.css'
);;

