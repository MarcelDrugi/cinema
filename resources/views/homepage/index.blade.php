@extends('layouts.base')

@section('content')
	@if($action)
		@if($action == "logged")
			<div class="alert alert-success alert-dismissible" role="alert">
            	ZALOGOWANO POMYŚLNIE
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
		@elseif($action == "registered")
			<div class="alert alert-success alert-dismissible" role="alert">
            	KONT UTWORZONO POMYŚLNIE, JESTEŚ ZALOGOWANY
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
        @elseif($action == "new_employee")
			<div class="alert alert-success alert-dismissible" role="alert">
            	KONT PRACOWNIKA ZOSTAŁO DODANE
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
		@endif
	@endif
	<h1>Witaj na stronie głównej</h1>
    <div>
    	@foreach ($movies as $m)
        	<p>tytuł: {{ $m->title }}</p>
        	<p>plakat:</p>
        	<img src="{{ $m->poster }}">
    	@endforeach
    </div>
@endsection
