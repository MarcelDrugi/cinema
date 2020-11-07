@extends('layouts.base')

@section('content')
	<h3>
		{{ __('To view this resource you need permissions') }}: <b>{{ $role }}</b>.
	</h3>
@endsection
