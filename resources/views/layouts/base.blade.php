<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <title>KLASYKA KINA</title>
    
        <!-- Scripts -->
        <script src="/js/app.js"></script>
    
        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
    
	</head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        	<div class="collapse navbar-collapse">
        		<ul class="navbar-nav">
                	<li class="nav-item">
                  		<a class="nav-link" href="/repertoire">Repertuar</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" href="/pricing">Cennik</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" href="/about">O nas</a>
                  	</li>
                  	<li class="nav-item">
                    	<a class="nav-link" href="/api-description">API z repertuarem</a>
                  	</li>
            	</ul>
            	<div class="ml-auto">
                	<a class="btn btn-outline-success" href="/signin">Logowanie</a>
                	<a class="btn btn-outline-success" href="/signup">Rejestracja</a>
            	</div>
        	</div>
        </nav>
        
    	<section class="section">
    		@yield('content')
    	</section>
    </body>
</html>