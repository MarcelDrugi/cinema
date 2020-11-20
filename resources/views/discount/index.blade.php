
@extends('layouts.base')

@section('content')
    <div>
    	<ul class="nav nav-tabs">
    		<li class="nav-item"><a class="nav-link" href="{{ route('movie.index') }}">{{ __('edit movie') }}</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('discount.index') }}">{{ __('discounts') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('screening.index') }}">{{ strtolower(__('SCREENINGS')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('modify-pricing.index') }}">{{ strtolower(__('PRICINGS')) }}</a></li>
    	</ul>
    </div>
    @if($newDiscount)
		<div class="alert alert-success alert-dismissible" role="alert">
        	{{ __('A NEW DISCOUNT HAS BEEN CREATED') }}! <br />
        	{{ __('code') }}: <b>{{ $newDiscount->code }}</b> <br />
        	@if($newDiscount->user_id)
        		{{ __('Discount assigned to the customer') }}: <b> {{ $newDiscount->user->first_name }} {{ $newDiscount->user->last_name }} </b>.
        	@else
        		{{ __('The discount coupon has not been assigned to any customer') }}.
        	@endif
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@elseif($deletedDiscount)
		<div class="alert alert-success alert-dismissible" role="alert">
        	{{ __('Removed discount with code') }}: <b>{{ $deletedDiscount }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@endif
	<h2>{{ __('DISCOUNTS') }}</h2>
	<h4>{{ __('Enter a new discount coupon') }}:</h4>
	<div class="col-md-8">
    	<form method="post" action="{{ route('discount.store') }}">
    		@csrf
           
            <div class="form-group row">
                <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('value') }}: </label>

                <div class="col-md-6">
                    <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autocomplete="value" autofocus>

                    @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
                	
            <div class="form-group row">
        		<label for="new_movie">{{ __('Assign a discount to a specific customer') }}: </label>
                <input id="customerCheckBox" type="checkbox"  name="customerCheckBox" onclick="forCustomer()">
            </div>
            
    		<div id="customers" class="form-group row" style="display: none;">
            	<label for="customerSelect"> {{ __('Customers') }}: </label>
            	<select class="form-control" id="customerSelect" name="customerSelect">
            		<option selected="selected" disabled>{{ __('select customer') }}</option>
            		@foreach($customers as $customer)
                  		<option value="{{ $customer->id }}">{{ $customer->last_name }} {{ $customer->first_name }} ({{ $customer->email }})</option>
                  	@endforeach
                </select>
    		</div>
    		<button type="submit">{{ __('ACCEPT') }}</button>
    	</form>
	</div>
	<h4>{{ __('Delete existing discount coupon') }}:</h4>
	<form method="post" action="{{ route('discount.destroy') }}">
		@csrf
		@method('DELETE')
		<select class="form-control delDiscount" id="selectDiscount" name="selectDiscount" onchange="showButton(event)">
    		<option selected="selected" disabled>{{ __('select discount') }}</option>
    		@foreach($discounts as $discount)
    			@if($discount->user_id)
          			<option class="withCustomer" value="{{ $discount }}">{{ $discount->code }} ({{ $discount->value * 100 }}%)</option>
          		@else
          			<option class="withoutCustomer" value="{{ $discount }}">{{ $discount->code }} ({{ $discount->value * 100 }}%)</option>
          		@endif
          	@endforeach
        </select>
        <button type="submit" id="deleteDiscount" style="display: none;">{{ __('DELETE') }}</button>
	</form>
	<div id="delWarning" style="display: none">
		<div>{{ __('WARNING! This discount is assigned to the account') }}:</div>
		<div id="userInfo"></div>
	</div>
	<div id="delInfo" style="display: none">
		{{ __('This discount is not assigned to any customer') }}.
	</div>
@endsection
