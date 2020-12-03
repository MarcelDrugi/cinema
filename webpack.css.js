const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css');

mix.less('resources/less/discount/index.less', '../resources/css/discount')
	    .less('resources/less/movie/index.less', '../resources/css/movie')
		.less('resources/less/layouts/base.less', '../resources/css/layouts')
		.less('resources/less/homepage/index.less', '../resources/css/homepage')
		.less('resources/less/global.less', '../resources/css/global')
		.less('resources/less/detail/index.less', '../resources/css/detail')
		.less('resources/less/repertoire/index.less', '../resources/css/repertoire')
		.less('resources/less/order/index.less', '../resources/css/order')
		.less('resources/less/ordersummary/index.less', '../resources/css/ordersummary')
		.less('resources/less/about/index.less', '../resources/css/about').combine([
	    'resources/css/discount/index.css',
		'resources/css/movie/index.css',
	    'resources/css/layouts/base.css',
		'resources/css/homepage/index.css',
		'resources/css/global/global.css',
		'resources/css/detail/index.css',
		'resources/css/repertoire/index.css',
		'resources/css/order/index.css',
		'resources/css/ordersummary/index.css',
		'resources/css/about/index.css',
	],
	'public/css/main.css'
);

