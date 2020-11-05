@extends('layouts.base')

@section('content')
	<div id="typeOfTicketsNumber" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
    	{{ __('ENTER A NUMBER') }}!
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
    	</button>
    </div>
    <div id="maxTicketsNumber" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
    	{{ __('THE MAXIMUM NUMBER OF TICKETS YOU CAN BOOK IS') }} {{ $freeTickets }}
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
    	</button>
    </div>
	<h1>{{ __('You buy a ticket for a screening') }}: <b>{{ $screening->movie->title }} ({{ date('d.m.Y - H:i', strtotime($screening->term->date_time)) }})</b></h1>
	<p>{{ __('Number of ree tickets') }}: {{ $freeTickets }}</p>
	<form method="post" action="{{ route('order.store') }}">
		@csrf
		@if($discounts)
    		{{ __('Discounts you can use') }}:
    		<div class="custom-control custom-radio">
                  <input type="radio" id="noDiscount" name="discountRadio" class="custom-control-input" value="0" onchange="display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})"checked>
                  <label class="custom-control-label" for="noDiscount"> {{ __("don't use discount") }} </label>
            </div>
        	@foreach($discounts as $discount)
        		<div class="custom-control custom-radio">
                    <input type="radio" id="{{ $discount->id }}" name="discountRadio" class="custom-control-input" value="{{ $discount->value }}" onchange="display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})">
                    <label class="custom-control-label" for="{{ $discount->id }}"> {{ $discount->code }} ({{ $discount->value * 100}}%)</label>
                </div>
        	@endforeach
    	@endif
    	<input id="discountId" name="discountId" type="hidden" value="noDiscount">
    	<div class="form-group row">
			<div class="col-md-6">
            	{{ __('Number of Tickets') }}:
            </div>
        </div>
		<div class="form-group row">
            <div class="col-md-6">
            	{{ __('NORMAL') }}:
                <button type="button" class="btn btn-secondary" onclick="decrement('normalTickets');display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})">-</button>
                <input type="text" class="form-control @error('normalTickets') is-invalid @enderror" value="{{ old('normalTickets') ? old('normalTickets') : '1' }}" name="normalTickets" id="normalTickets" onkeyup="valid(event);display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})" max="{{ $freeTickets }}">
                <button type="button" class="btn btn-secondary" onclick="increment('normalTickets');display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})">+</button>
                @error('normalTickets')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
            	{{ __('JUNIOR') }}:
                <button type="button" class="btn btn-secondary" onclick="decrement('juniorTickets');display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})">-</button>
                <input type="text" value="0" name="juniorTickets" id="juniorTickets" onkeyup="valid(event);display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})" max="{{ $freeTickets }}">
                <button type="button" class="btn btn-secondary" onclick="increment('juniorTickets');display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})">+</button>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
            	{{ __('SENIOR') }}:
                <button type="button" class="btn btn-secondary" onclick="decrement('seniorTickets');display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})">-</button>
                <input type="text" value="0" name="seniorTickets" id="seniorTickets" onkeyup="valid(event);display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})" max="{{ $freeTickets }}">
                <button type="button" class="btn btn-secondary" onclick="increment('seniorTickets');display({{ $screening->term->pricing->normal }}, {{ $screening->term->pricing->school }}, {{ $screening->term->pricing->senior }})">+</button>
            </div>
        </div>
        <input name="screeningId" type="hidden" value="{{ $screening->id }}">
		<button type="submit">{{__('ACCEPT')}}</button>
	</form>
	<div>{{ __('To pay') }}: <span id="pay">{{ $screening->term->pricing->normal }}</span> PLN</div>
@endsection
