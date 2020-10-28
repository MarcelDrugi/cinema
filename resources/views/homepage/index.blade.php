@extends('layouts.base')

@section('content')
	<h1>Witaj na stronie głównej</h1>
	<button type="button" class="btn btn-primary">Primary</button>
    <div>
    	@foreach ($movies as $m)
        	<p>tytuł: {{ $m->title }}</p>
        	<p>plakat:</p>
        	<img src="{{ $m->poster }}">
    	@endforeach
    </div>
@endsection
