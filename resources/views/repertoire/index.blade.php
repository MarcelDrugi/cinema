@extends('layouts.base')

@section('content')
	<h2> {{ __('Our repertoire for the next 7 days') }} ({{ $today }} - {{ $lastDay }}): </h2>
	@if($info)
		{{ $info->content }} <br>
	@endif
    <div>
    	<table class="table table-dark">
    		<thead>
            	<tr>
            		<th>{{ __('Title') }}</th>
            		@foreach($weekDays as $day)
            			<th>{{ __($day) }}</th>
            		@endforeach
            	</tr>
        	</thead>
        	<tbody>
        		@foreach($movies as $movie)
        		<tr>
        			<th colspan="8" class="table-secondary">{{ $movie->title }}</th>
        			@foreach($movie->sevenDaysScreenings as $screening)
        				<tr>
        				<td></td>
        				@foreach($weekDays as $day)
        					<td>@if($screening->term->day() == $day) 
            					{{ $screening->term->time() }}
            					<a type="button" class="btn btn-secondary btn-sm" href="{{ route('order.index', ['id' => $screening->id]) }}">{{ __('buy a ticket') }}</a> 
        					@endif</td>
        				@endforeach
        				</tr>
        			@endforeach
        		</tr>
        		@endforeach
    		</tbody>
		</table>
    </div>
@endsection