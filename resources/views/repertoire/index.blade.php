@extends('layouts.base')

@section('content')
	dzień tygodnia: 
	<h1> Oto nasz repertuar na najbliższe 7 dni ({{ $today }} - {{ $lastDay }}): </h1>
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
        					<td>@if($screening->term->day() == $day) {{ $screening->term->time() }} @endif</td>
        				@endforeach
        				</tr>
        			@endforeach
        		</tr>
        		@endforeach
    		</tbody>
		</table>
    </div>
@endsection