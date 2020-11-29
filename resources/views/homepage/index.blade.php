
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
    @if($info_top)
    	@if($info_top->content)
    		<div class="homepageTopContent">
    			<div class="background"></div>
    			{!! $info_top->content !!}
    		</div>
    	@endif
	@endif
	<div class="slidingName"> {{ __('CINEMA CLASSICS') }} </div>
	<img src="{{ asset('images/tape.png') }}" class="tapeBackground">
	<div class="posterRadio">
		<div class="radioCover"></div>
		@foreach ($movies as $m)
    		@if( $loop->index == 0)
        		<input type="radio" id="posterMark{{ $loop->index }}" name="poster" checked >
            @else
        		<input type="radio" id="posterMark{{ $loop->index }}" name="poster">
        	@endif
        @endforeach
	</div>
	<button onclick="nextPoster()" class="rightArrow"><img src="{{ asset('images/arrow_right.png') }}"></button>
	<button disabled onclick="previousPoster()" class="leftArrowStatic"><img src="{{ asset('images/arrow_left.png') }}"></button>
	<div class="slider">
    	@foreach ($movies as $m)
        	@if( $loop->index == 0)
        		<div class="poster poster{{ $loop->index }}">
        			<div class="titleBackground"></div>
        			<div class="movieTitle">
						<a href="#">{{ $m->title }} ({{$m->published}})</a>
        			</div>
            		<img src="{{ $m->poster }}">
            	</div>
        	@else
            	<div class="beginHiddenPoster poster{{ $loop->index }}">
            	<div class="titleBackground"></div>
            		<div class="movieTitle">
						<a href="#">{{ $m->title }} ({{$m->published}})</a>
        			</div>
            		<img src="{{ $m->poster }}">
            	</div>
        	@endif
    	@endforeach
	</div>
	@if($info_slider)
		@if($info_slider->content)
    		<div class="sliderInfo">
    			<div class="sliderInfoBackground"></div>
    			{!!  $info_slider->content !!}
    		</div>
		@endif
	@endif
	@if($info_bottom)
		@if($info_slider->content)
			<div class="homepageBottomInfo">
				<div class="sliderInfoBackground"></div>
				{!!  $info_bottom->content !!}
			</div>
		@endif
	@endif
@endsection
