@extends('layouts.base')

@section('content')
	<h2>{{ __('Order summary') }}</h2>
	{{ __('You buy') }} {{ $summOfTickets }} {{ __('tickets for the amount') }}: {{ $toPay }} {{ __('EUR') }}<br>
	@if($discountId)
		{{ __('you use the discount') }}: {{ $discountId }} <br />
	@endif
	<a href="{{ url()->previous() }}">{{ __('Back') }}</a>
	<form method="post" action="">
		<a href="">{{ _('ACCEPT') }}</a>
	</form>
@endsection