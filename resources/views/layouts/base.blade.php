
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
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-4">Fluid jumbotron</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
          </div>
        </div>
    	<section class="section" id="basicSection" >
    		@yield('content')
    	</section>
    </body>
</html>