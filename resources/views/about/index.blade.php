@extends('layouts.base')

@section('content')
	<div class="aboutTop">
    	@if($info_left)
    		<div class="aboutInfoLeft">
    			{!! $info_left->content !!}
    		</div>
    	@endif
    	@if($info_right)
    		<div>
        		<div class="aboutTitle">{{ __('About our cinema') }}</div>
        		<div class="aboutInfoRight">
        			{!! $info_right->content !!}
        			<div class="infoBackground"></div>
        		</div>
    		</div>
    	@endif
    </div>
	@if($info_bottom)
		<div class="aboutInfoBottom">
			<div class="infoBackground"></div>
			{!! $info_bottom->content !!}
		</div>
	@endif
	<div class="aboutBackgroundImg3"><img src="{{ asset('images/about3.png') }}"></div>
	<div class="aboutBackgroundImg4"><img src="{{ asset('images/about4.png') }}"></div>
	<div class="aboutBackgroundImg5"><img src="{{ asset('images/about5.png') }}"></div>
	<div class="aboutBackgroundImg6"><img src="{{ asset('images/about6.png') }}"></div>
@endsection