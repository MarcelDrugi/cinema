
<script>

const showHero = () => {
	const hero = document.getElementsByClassName('jumbotron')[0];

	if (hero.style.display == '' || hero.style.display == 'none') {
		hero.style.display = 'block';
		hero.classList.add('jumbotron-full');
	}
	else {
		hero.style.display = 'none';
		hero.classList.remove('jumbotron-full');
	}
	
};

const standartBackground = (id) => {
	const background = document.getElementsByClassName('heroBackground' + id)[0];
	background.classList.remove('heroBackground' + id);
	background.classList.add('heroBackground');
	
	const downTriangle = document.getElementsByClassName('downTriangleTransformed')[0];
	downTriangle.classList.remove('downTriangleTransformed');
	downTriangle.classList.add('downTriangle');
	
	const topTriangle = document.getElementsByClassName('topTriangleTransformed')[0];
	topTriangle.classList.remove('topTriangleTransformed');
	topTriangle.classList.add('topTriangle');
}

const newBackground = (id) => {
	const background = document.getElementsByClassName('heroBackground')[0];
	background.classList.remove('heroBackground');
	background.classList.add('heroBackground' + id);
	
	const downTriangle = document.getElementsByClassName('downTriangle')[0];
	downTriangle.classList.remove('downTriangle');
	downTriangle.classList.add('downTriangleTransformed');
	
	const topTriangle = document.getElementsByClassName('topTriangle')[0];
	topTriangle.classList.remove('topTriangle');
	topTriangle.classList.add('topTriangleTransformed');
}

</script>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <title>{{ __('CINEMA CLASSICS') }}</title>
    
        <!-- Scripts -->
        <script src="/js/app.js"></script>
		<script src="/js/main.js"></script>
        
    
        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">
    
	</head>

    <body>
    <!--
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        	<div class="collapse navbar-collapse">
        		<ul class="navbar-nav">
                	<li class="nav-item">
                  		<a class="nav-link" href="/">{{ __('Homepage') }}</a>
                  	</li>
                  	<li class="nav-item">
                  		<a class="nav-link" href="/repertoire">{{ __('Repertoire') }}</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" href="/pricing">{{ __('Pricing') }}</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" href="/about">{{ __('About') }}</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" href="/api-description">{{ __('API with repertoire') }}</a>
                  	</li>
                  	@if (Auth::user())
                  		@if (Auth::user()->hasRole("admin"))
                          	<li class="nav-item">
                            	<a class="nav-link" href="/admin">{{ __('Administration panel') }}</a>
                          	</li>
                      	@endif
                  	@endif
                  	@if (Auth::user())
                  		@if (Auth::user()->hasRole("employee"))
                          	<li class="nav-item">
                            	<a class="nav-link" href="/movie">{{ __('Employee panel') }}</a>
                          	</li>
                      	@endif
                  	@endif
            	</ul>
            	@if (Auth::user())
            		<div class="ml-auto">
            			@if(Auth::user()->hasRole("customer"))
            				<a class="btn btn-outline-success" href="{{ route('profile.index') }}"> {{ __('edit profile') }}</a>
            			@endif
            			@if(Auth::user()->avatar)
            				<img src="{{ Auth::user()->avatar }}" width="70" height="70">
            			@else
            				<img src="{{ asset('images/no-avatar.png') }}" width="70" height="70">
            			@endif
            			{{ Auth::user()->first_name }}
            			{{ Auth::user()->last_name }}
            			<a class="btn btn-outline-success" href="{{ route('logout') }}">{{ __('sign out') }}</a>
            		</div>
            	@else
            		<div class="ml-auto">
                    	<a class="btn btn-outline-success" href="/login">{{ __('sign in') }}</a>
                    	<a class="btn btn-outline-success" href="/register">{{ __('sign up') }}</a>
            		</div>
            	@endif
        	</div>
        </nav>
         -->
		<div class="hamburger" onclick="showHero()"></div>
		@if(Auth::user())
    		<div class="userInfo">
    			@if(Auth::user()->avatar)
    				<div class="avatar"><img src="{{ Auth::user()->avatar }}"></div>
    			@else
    				<div class="avatar"><img src="{{ asset('images/no-avatar.jpg') }}"></div>
    			@endif
    			<div class="names">
        			{{ Auth::user()->first_name }}<br />
        			{{ Auth::user()->last_name }}<br />
        			<a class="btn btn-success" href="{{ route('logout') }}">{{ __('sign out') }}</a>
    			</div>
    			@if(Auth::user()->hasRole("customer"))
        			<div class="accEdit">
        				<a class="btn btn-warning" href="{{ route('profile.index') }}"> {{ __('your profile') }}</a>
        			</div>
    			@endif
    		</div>
        @endif
        <div class="jumbotron jumbotron-fluid">
        	<div class="downTriangle"></div>
        	<div class="topTriangle"></div>
        	<div class="heroBackground"></div>
			<div class="container">
            	<h1 class="display-4">{{ __('CINEMA CLASSICS') }}</h1>
            	<p class="lead">{{ __('The most important, loudest and best movies ever. A classic of world cinema in remastered quality.') }}</p>
            	<ul class="navbar-nav">
                	<li class="nav-item">
                  		<a class="nav-link" onmouseenter="newBackground(1)" onmouseleave="standartBackground(1)" href="/">{{ __('Homepage') }}</a>
                  	</li>
                  	<li class="nav-item">
                  		<a class="nav-link" onmouseenter="newBackground(2)" onmouseleave="standartBackground(2)" href="/repertoire">{{ __('Repertoire') }}</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" onmouseenter="newBackground(3)" onmouseleave="standartBackground(3)" href="/pricing">{{ __('Pricing') }}</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" onmouseenter="newBackground(4)" onmouseleave="standartBackground(4)" href="/about">{{ __('About') }}</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" onmouseenter="newBackground(5)" onmouseleave="standartBackground(5)" href="/api-description">{{ __('API with repertoire') }}</a>
                  	</li>
                  	@if (Auth::user())
                  		@if (Auth::user()->hasRole("admin"))
                          	<li class="nav-item">
                            	<a class="nav-link" onmouseenter="newBackground(6)" onmouseleave="standartBackground(6)" href="/admin"><span class="notCustomer">{{ __('Administration panel') }}</span></a>
                          	</li>
                      	@endif
                  	@endif
                  	@if (Auth::user())
                  		@if (Auth::user()->hasRole("employee"))
                          	<li class="nav-item">
                            	<a class="nav-link" onmouseenter="newBackground(6)" onmouseleave="standartBackground(6)" href="/movie"><span class="notCustomer">{{ __('Employee panel') }}</span></a>
                          	</li>
                      	@endif
                  	@endif
              	</ul>
              	@if(!Auth::user())
            		<div class="heroButtons">
                    	<a class="btn btn-outline-secondary" href="/login">{{ __('sign in') }}</a>
                    	<a class="btn btn-outline-secondary" href="/register">{{ __('sign up') }}</a>
            		</div>
        		@endif
			</div>
        </div>
    	<section class="section" id="basicSection" >
    		@yield('content')
    	</section>
    </body>
</html>