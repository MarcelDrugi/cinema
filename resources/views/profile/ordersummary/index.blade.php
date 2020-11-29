@extends('layouts.base')

@section('content')
	<h2>{{ __('Order summary') }}</h2>
	{{ __('You buy') }} {{ $summOfTickets }} {{ __('tickets for the amount') }}: {{ number_format($toPay, 2) }} {{ __('EUR') }}<br>
	@if($normalTickets > 0)
	{{ __('Normal')}}: {{ $normalTickets }}<br />
	@endif
	@if($juniorTickets > 0)
	{{ __('School')}}: {{ $juniorTickets }}<br />
	@endif
	@if($seniorTickets > 0)
	{{ __('Senior')}}: {{ $seniorTickets }}<br />
	@endif
	@if($discount)
		{{ __('you use the discount') }}: {{ $discount->code }} <br />
	@endif
	<a href="{{ url()->previous() }}">{{ __('Back') }}</a>
	<form method="post" action="">
		<a href="">{{ _('ACCEPT') }}</a>
	</form>
	
	<table border="0" cellpadding="10" cellspacing="0" align="center">
    	<tr>
    		<td align="center"></td>
    	</tr>
    	<tr>
    		<td align="center">
    			<a href="https://www.paypal.com/in/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">
    				<img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo">
    			</a>
    		</td>
    	</tr>
	</table>
    
    <div>NOWE</div>
    <form method="POST" action="{{ route('create-reservation') }}">
        @csrf
         <input type="hidden" name="toPay" value="{{ $toPay }}" >
        <button>Pay Now</button>
    </form>
	
@endsection