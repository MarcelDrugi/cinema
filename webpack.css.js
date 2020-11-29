const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css');

mix.less('resources/less/discount/index.less', '../resources/css/discount')
	    .less('resources/less/movie/index.less', '../resources/css/movie')
		.less('resources/less/layouts/base.less', '../resources/css/layouts')
		.less('resources/less/homepage/index.less', '../resources/css/homepage')
		.less('resources/less/global.less', '../resources/css/global').combine([
	    'resources/css/discount/index.css',
		'resources/css/movie/index.css',
	    'resources/css/layouts/base.css',
		'resources/css/homepage/index.css',
		'resources/css/global/global.css',
	],
	'public/css/main.css'
);;

