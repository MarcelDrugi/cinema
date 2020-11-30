
@extends('layouts.base')

@section('content')
	<div class="detailPoster">
		<img src="{{ $movie->poster }}">
	</div>
	<div class="movieDetail">
    	<div class="detailBackground"></div>
    	<div class="detailTitle"> {{ $movie->title }} </div>
    	<div class="detailDescription"> {{ $movie->description }} </div>
    </div>
	<div class="yearsDetail">
		<div class="detailSmallBackground"></div> 
		+ {{ $movie->age_limit }} {{ __('years old') }} 
	</div>
	<div class="publishedDetail">
		<div class="detailSmallBackground"></div>
		{{ __('movie published') }}: {{ $movie->published }}
		</div>
	<div class="timeDetail">
		<div class="detailSmallBackground"></div>
		{{ $movie->time }} min.
	</div>
	<div class="detailNeonTitle">{{ $movie->title }}</div>
	<div class="detailCameraBackground">
		<img src="{{ asset('images/camera.png') }}">
	</div>
	
	<div class="detailTermTable">
		<div class="detailTableDescription">
			<div class="detailSmallBackground"></div>
			{{ __('Screenings of this movie in the coming week') }}:
		</div>
    	<table class="table table-striped">
        	<tr>
            	<th>{{ __('week day') }}</th>
            	<th>{{ '08 - 10' }}</th>
            	<th>{{ '10 - 12' }}</th>
            	<th>{{ '12 - 14' }}</th>
            	<th>{{ '14 - 16' }}</th>
            	<th>{{ '16 - 18' }}</th>
            	<th>{{ '18 - 20' }}</th>
            	<th>{{ '20 - 22' }}</th>
            	<th>{{ '22 - 00' }}</th>
            </tr>
        	@foreach($termsWithDays as $day => $hours)
        		<tr>
        		<td>{{ __($day) }}</td>
            		@foreach($hours as $hour => $terms)
            			@if(empty($terms))
            				<td></td>
            			@else
            				<td>
                    			@foreach($terms as $term)
                    				{{ date('H:i', strtotime($term->date_time)) }}<br>
                    			@endforeach
                			</td>
                		@endif
            		@endforeach
        		</tr>
        	@endforeach
    	</table>
    </div>
    
    <div class="detailTicketsInfo">
    	<div class="detailSmallBackground"></div>
		{{ __('To buy tickets, go to the tab') }}:  <a href="{{ route('pricing.index') }}"> {{ __('Repertoire') }} </a>
	</div>
	
@endsection
