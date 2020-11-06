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
    <form method="POST" action="{{ route('create-payment') }}">
        @csrf
        <div class="m-2">
         <input type="text" name="amount" placeholder="Amount">
         @if ($errors->has('amount'))
         <span class="error"> {{ $errors->first('amount') }} </span>
         @endif
        </div>
        <button>Pay Now</button>
    </form>
	
@endsection