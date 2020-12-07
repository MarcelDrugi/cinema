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
		<div class="pageLoader">
			<img src="{{ asset('images/loader.png') }}">
		</div>
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
    	<footer class="footer py-4 bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-sm text-center"> Created by <b>Piotr Mazur</b> </div>
					<div class="col-sm text-center"> <b>piotr.a.mazur@wp.pl</b> </div>
					<div class="col-sm text-center"><a href="https://github.com/MarcelDrugi/cinema"> <img class="git" src="{{ asset('images/gh.png') }}">github.com/MarcelDrugi/cinema</a> </div>
				</div>
			</div>
		</footer>
    </body>
</html>