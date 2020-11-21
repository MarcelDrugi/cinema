
@extends('layouts.base')

@section('content')
	<h2>{{ __('PRICINGS') }}</h2>
	<div>
	@if($info)
		{!! nl2br(e($info->content)) !!}
	@endif
	</div>
	
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
	
@endsection