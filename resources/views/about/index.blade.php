@extends('layouts.base')

@section('content')
	<h2> {{ __('About') }}  </h2>
	@if($info_side)
		{{ $info_side->content }} <br>
	@endif
	@if($info_bottom)
		{{ $info_bottom->content }}
	@endif
@endsection