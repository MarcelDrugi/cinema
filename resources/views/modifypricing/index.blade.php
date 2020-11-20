
@extends('layouts.base')

@section('content')
	<div>
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link" href="{{ route('movie.index') }}">{{ __('edit movie') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('discount.index') }}">{{ __('discounts') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('screening.index') }}">{{ strtolower(__('SCREENINGS')) }}</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('modify-pricing.index') }}">{{ strtolower(__('PRICINGS')) }}</a></li>
		</ul>
	</div>
	@if($pricingCreated)
		<div class="alert alert-success alert-dismissible" role="alert">
        	<b>{{ __('A new price list has been added.') }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
    @endif
	@if($pricingDeleted)
		<div class="alert alert-success alert-dismissible" role="alert">
        	<b>{{ __('One of the price lists has been removed.') }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
    @endif
    @if($pricingModified)
		<div class="alert alert-success alert-dismissible" role="alert">
        	<b>{{ __('One of the price lists has been modified.') }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@endif
	@if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
      	<b>{{ __('EDIT ERROR') }}</b>
        <ul>
            @foreach (array_unique($errors->all()) as $error)
               <li>{{ ucfirst($error) }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
      </div>
	@endif
	<h2>{{ __('PRICINGS') }}</h2>
	
	<form method="post" id="modifyPricing" action="{{ route('modify-pricing.update') }}">
    	@csrf
    	@method('PUT')
    	
    	<table>
    		<tr>
        		<th>{{ __('week day') }}</th>
                <th>{{ strtolower(__('Normal')) }}</th>
                <th>{{ strtolower(__('School')) }}</th>
                <th>{{ strtolower(__('Senior')) }}</th>
          	</tr>
        	@foreach($weekDays as $weekDay)
        		<tr>
        		<td>{{ __($weekDay) }}</td>
        		@php $exist = false; @endphp
        		@foreach($pricings as $pricing)
        			@if($pricing->week_day == $weekDay)
        				@php $exist = true; @endphp
    					<td>
            				<div class="form-group row ">
                                <div class="col-md-6">
                                    <input type="text" name="{{ $weekDay . 'normal' }}" onchange="activePricingButton()" value="{{ old($weekDay . 'normal') ? old($weekDay . 'normal') : $pricing->normal }}">
                                </div>
                        	</div>
                        </td>
                        <td>
                        	<div class="form-group row ">
                                <div class="col-md-6">
                                    <input type="text" name="{{ $weekDay . 'school' }}" onchange="activePricingButton()" value="{{ old($weekDay . 'school') ? old($weekDay . 'school') : $pricing->school }}">
                                </div>
                        	</div>
                        </td>
                        <td>
                        	<div class="form-group row ">
                                <div class="col-md-6">
                                    <input type="text" name="{{ $weekDay . 'senior' }}" onchange="activePricingButton()" value="{{ old($weekDay . 'senior') ? old($weekDay . 'senior') : $pricing->senior }}">
                                </div>
                        	</div>
                    	</td>
        			@endif
            	@endforeach
            	@if(!$exist)
            		<td>
        				<div class="form-group row ">
                            <div class="col-md-6">
                                <input type="text" name="{{ $weekDay . 'normal' }}" onchange="activePricingButton()" value="{{ old($weekDay . 'normal') }}">
                            </div>
                    	</div>
                    </td>
                    <td>
                    	<div class="form-group row ">
                            <div class="col-md-6">
                                <input type="text" name="{{ $weekDay . 'school' }}" onchange="activePricingButton()" value="{{ old($weekDay . 'school') }}">
                            </div>
                    	</div>
                    </td>
                    <td>
                    	<div class="form-group row ">
                            <div class="col-md-6">
                                <input type="text" name="{{ $weekDay . 'senior' }}" onchange="activePricingButton()" value="{{ old($weekDay . 'senior') }}">
                            </div>
                    	</div>
                	</td>
            	@endif
            	</tr>
        	@endforeach
    	</table>
    	
		<button type="submit" id="updatePricingButton" disabled>{{ __('ACCEPT') }}</button>
	</form>
	
@endsection