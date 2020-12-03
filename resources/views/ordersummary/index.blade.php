@extends('layouts.base')

@section('content')
	<div class="summaryTitle">{{ __('Order summary') }}</div>
	<div class="summaryPrice">
		<div class="summaryBackground"></div>
		{{ __('You buy') }} {{ $summOfTickets }} {{ __('tickets for the amount') }}: <b>{{ number_format($toPay, 2) }}</b> {{ __('EUR') }}
	</div>
	<div class="summaryNumberOfTickets">
		<div class="summaryBackground"></div>
    	@if($normalTickets > 0)
    		<div>{{ __('Normal')}}: <b>{{ $normalTickets }}</b></div>
    	@endif
    	@if($juniorTickets > 0)
    		<div>{{ __('School')}}: <b>{{ $juniorTickets }}</b></div>
    	@endif
    	@if($seniorTickets > 0)
    		<div>{{ __('Senior')}}: <b>{{ $seniorTickets }}</b></div>
    	@endif
    	@if($discount)
    		<div>{{ __('you use the discount') }}: <b>{{ $discount->code }}</b></div>
    	@endif
	</div>
	<div class="summaryPayPalBackground">
		<img src="{{ asset('images/paypal.png') }}"border="0" alt="PayPal Logo">
	</div>
	<div class="summaryButtons">
		<div>
			<a class="btn btn-dark" href="{{ url()->previous() }}">{{ __('Back') }}</a>
		</div>
		<div>
    		<form method="POST" action="{{ route('create-reservation') }}">
                @csrf
    			<input type="hidden" name="toPay" value="{{ $toPay }}">
                <button class="btn btn-success">{{ __('Pay Now') }}</button>
        	</form>
        </div>
	</div>
	<div class="summaryBackgroundImg">
		<img src="{{ asset('images/summary.png') }}"border="0" alt="PayPal Logo">
	</div>
@endsection