@extends('layouts.base')

@section('content')
	@isset($action)
		@if($action == "logged")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('LOG IN SUCCESSFULLY') }}
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
		@elseif($action == "registered")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('YOUR ACCOUNT DONE SUCCESSFULLY, YOU ARE LOGGED IN') }}
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
        @elseif($action == "new_employee")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('THE EMPLOYEE ACCOUNT HAS BEEN ADDED') }}
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
        @elseif($action == "paid")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('PAYMENT DONE SUCCESSFULLY') }}! <br />
            	{{ __('You can view the booking in the user panel') }}<br>
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
        @elseif($action == "nonpaid")
			<div class="alert alert-success alert-dismissible" role="alert">
            	<b>{{ __('BOOKING DONE BUT PAYMENT DID NOT SUCCESSFULLY') }}</b><br/>
            	{{ _('You can try to pay again in the profile panel') }}.
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
