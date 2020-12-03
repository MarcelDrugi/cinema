
@extends('layouts.base')

@section('content')
	<div class="repertoireTitle"> {{ __('Our repertoire for the next 7 days') }} ({{ $dates[0] }} - {{ $dates[6] }}) </div>
	<div class="repertoireImageBackground"><img src="{{ asset('images/repertoire.png') }}"></div>
	<div class="repertoireImageBackgroundNun"><img src="{{ asset('images/repertorie_nun.png') }}"></div>
	<div class="repertoireContent">
		<div class="background "></div>
    	@if($info)
    		{!! $info->content  !!} <br>
    	@endif
	</div>
	
	<div class="dayButtons">
    	@foreach($termsWithDays as $day => $movies)
    		@if($loop->index == 0)
        		<button onclick="chooseDay('{{$day}}')" id="btn{{ $day }}" class="repertoireBtn activeRepertoireBtn">{{ __($day) }} <br /> {{$dates[$loop->index]}}</button>
        	@else
    			<button onclick="chooseDay('{{$day}}')" id="btn{{ $day }}" class="repertoireBtn">{{ __($day) }} <br /> {{$dates[$loop->index]}}</button>
    		@endif
    	@endforeach
	</div>
	@foreach($termsWithDays as $day => $movies)
	@if($loop->index == 0)
		<div id="rep{{ $day }}" class="repertoireTable">
	@else
		<div id="rep{{ $day }}" class="repertoireTable" style="display: none;">
	@endif
		<div class="repertoireTableTitle"> {{ __($day) }} </div>
		<table class="table table-striped">
        	<tr>
            	<th></th>
            	<th class="centerElement">{{ '08 - 10' }}</th>
            	<th class="centerElement">{{ '10 - 12' }}</th>
            	<th class="centerElement">{{ '12 - 14' }}</th>
            	<th class="centerElement">{{ '14 - 16' }}</th>
            	<th class="centerElement">{{ '16 - 18' }}</th>
            	<th class="centerElement">{{ '18 - 20' }}</th>
            	<th class="centerElement">{{ '20 - 22' }}</th>
            	<th class="centerElement">{{ '22 - 00' }}</th>
            </tr>
        	@foreach($movies as $title => $hours)
        		<tr>
        		<td><b>&nbsp;&nbsp;<a href="{{route('moviedetail.index', ['id'=> $allMovies->where('title', $title)->first()->id])}}">{{ $title }}</a></b></td>
            		@foreach($hours as $hour => $terms)
            			@if(empty($terms))
            				<td></td>
            			@else
            				<td class="centerElement">
                    			@foreach($terms as $term)
                    				{{ date('H:i', strtotime($term->date_time)) }}
                    				<br />
                    				<a type="button" class="btn btn-secondary btn-sm" href="{{ route('order.index', ['id' => $term->screening->id]) }}">{{ __('buy a ticket') }}</a>
                    				<br />
                    			@endforeach
                			</td>
                		@endif
            		@endforeach
        		</tr>
        	@endforeach
    	</table>
	</div>
	@endforeach
	
@endsection