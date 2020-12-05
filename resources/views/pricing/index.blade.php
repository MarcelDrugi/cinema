
@extends('layouts.base')

@section('content')
	<div class="pricinContent">
		<div class="pricingBackground"></div>
    	@if($info)
    		@if(!empty($info->content))
    			{!! $info->content !!}
    		@endif
    	@endif
	</div>
	<!-- 
	<table>
    	<tr>
        	<th>{{ __('week day') }}</th>
            <th>{{ strtolower(__('Normal')) }}</th>
            <th>{{ strtolower(__('School')) }}</th>
            <th>{{ strtolower(__('Senior')) }}</th>
            <th>{{ strtolower(__('Currency')) }}</th>
        </tr>
    	@foreach($weekDays as $weekDay)
    		@foreach($pricings as $pricing)
    			@if($pricing->week_day == $weekDay)
    				@if($weekDay == $today)
                      	<tr style="color:red">
            				<td>{{ __($pricing->week_day) }}</td>
            				<td>{{ $pricing->normal }}</td>
            				<td>{{ $pricing->school }}</td>
            				<td>{{ $pricing->senior }}</td>
            				<td>{{ __('EUR') }}</td>
            			</tr>
            		@else
                		<tr>
            				<td>{{ __($pricing->week_day) }}</td>
            				<td>{{ $pricing->normal }}</td>
            				<td>{{ $pricing->school }}</td>
            				<td>{{ $pricing->senior }}</td>
            				<td>{{ __('EUR') }}</td>
            			</tr>
        			@endif
            	@endif
    		@endforeach
    	@endforeach
	</table>
	 -->
	<div class="pricingTitle">{{ __('STANDART PRICINGS') }}</div>
	<div class="pricingCardWrapper">
    	@foreach($pricings as $pricing)
        	<div class="pricingCard{{$loop->index}}" id="pricing{{$loop->index}}">
            	<div class="pricingCardTitle">{{ __($pricing->week_day) }}</div>
            	<div class="pricingTicketName">{{ strtolower(__('Normal')) }}:</div> <div class="pricingCardPrice"><b>{{ $pricing->normal }}</b> {{ strtolower(__('EUR')) }}</div>
            	<div class="pricingTicketName">{{ strtolower(__('School')) }}:</div> <div class="pricingCardPrice"><b>{{ $pricing->school }}</b> {{ strtolower(__('EUR')) }}</div>
            	<div class="pricingTicketName">{{ strtolower(__('Senior')) }}:</div> <div class="pricingCardPrice"><b>{{ $pricing->senior }}</b> {{ strtolower(__('EUR')) }}</div>
        	</div>
    	@endforeach
	</div>
	<div class="pricingButtons">
    	<button onclick="pricingRight()" class="pricingRightArrow"><img src="{{ asset('images/pricing_arrow_left.png') }}"></button>
    	<button onclick="pricingLeft()" class="pricingLeftArrow"><img src="{{ asset('images/pricing_arrow_right.png') }}"></button>
	</div>
	<div class="pricingBackgroundImg1"><img src="{{ asset('images/pricing1.png') }}" ></div>
	<div class="pricingBackgroundImg2"><img src="{{ asset('images/pricing2.png') }}" ></div>
@endsection