@extends('layouts.base')

@section('content')
	<h2> {{ __('REPERTOIRE-API DESCRIPTION') }}  </h2>
	@if($info)
		{{ $info->content }} <br>
	@endif
@endsection