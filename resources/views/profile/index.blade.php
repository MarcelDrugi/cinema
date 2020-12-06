
@extends('layouts.base')

@section('content')
	@if($action)
		@if($action == "newData")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('DATA CHANGED SUCCESSFULLY') }}
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
		@endif
	@endif
	<div class="profileTitle">{{ __('Edit your profile') }}:</div>
	<div class="modifyProfile">
		<div class="profileBakgroundImg2">
        	<img src="{{ asset('images/profile2.png') }}">
        </div>
		<div class="profileBakcground"></div>
    	<form method="POST" action="{{ route('profile.update', ['profile' => $user->id]) }}" enctype="multipart/form-data">
    		@csrf
    		@method('PUT')
        	<div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
    
                <div class="col-md-8">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ? old('first_name') : $user->first_name }}" required autocomplete="first_name">
    
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
    
                <div class="col-md-8">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ? old('last_name') : $user->last_name }}" required autocomplete="last_name">
    
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                <div class="col-md-8">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $user->email }}" required autocomplete="email">
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
    		</div>
    		<div class="form-group row">
                <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar</label>
    
                <div class="col-md-8 text-md-left">
                    <input id="avatar" type="file" onchange="newAvatar(event)" class="@error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}">
    				<img id="changeAvatar"/>
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <!--<label for="changePass" class="col-md-4 col-form-label text-md-right">{{ __('change the password') }}</label>
                <input type="checkbox" name="changePass" onchange="newPass(this)">  -->
                <div class="col-md-5 text-md-right custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" id="changePass" name="changePass" onchange="newPass(this)">
                    <label class="custom-control-label" for="changePass">{{ __('change the password') }}</label>
                </div>
            </div>
            <div id="newPass" style="display: @if($errors->first('password')) block @else none @endif">
        		<div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info">{{ __('ACCEPT') }}</button>
    	</form>
	</div>
	<div class="profileInfoWrapper">
    	<div class="profileInfo">
    		<div class="profileBakcground"></div>
        	<div class="profileReservations col">
        		<div class="profileSubitle"> {{__('YOUR RESERVATIONS') }}: </div>
        		<div class="profilReservationsContent">
        			@if($reservations->isNotEmpty())
        				<ul>
                			@foreach($reservations as $reservation)
                    			<li>
                        			{{ $reservation->screening->movie->title }} ({{ __($reservation->screening->term->day()) }} - {{ date('d.m.Y - H:i', strtotime($reservation->screening->term->date_time)) }})
                        			@if($reservation->payment_status)
                        				<b style="color: green;"> {{ __('paid') }} </b>
                        			@else
                        				<b style="color: red;"> {{ __('not paid') }} </b>
                        				<form action="{{ route('profile.store') }}" method="post">
                        					@csrf
                        					<input type="hidden" value="{{ $reservation->id }}" name="reservationId">
                        					<button class="btn btn-warning" type="submit">{{ __('pay for') }}</button>
                        				</form>
                        			@endif
                        		</li>
                			@endforeach
                		</ul>
                	@else
                		<div><b>- {{ __('no reservations') }} -</b></div>
                	@endif
            	</div>
        	</div>
        	<div class="profileDiscoutns col">
        		<div class="profileSubitle"> {{__('YOUR DISCOUNTS') }}: </div>
        		<div class="profileDiscoutnsContent">
        			@if($discounts->isNotEmpty())
            			<ul>
                    		@foreach($discounts as $discount)
                    			<li>{{ $discount->code }} <b>&nbsp;({{ $discount->value * 100 }}%)</b></li>
                    		@endforeach
                		</ul>
            		@else
                		<div><b>- {{ __('no discounts') }} -</b></div>
                	@endif
        		</div>
        	</div>
        </div>
    </div>
    <div class="profileBakgroundImg1">
    	<img src="{{ asset('images/profile1.png') }}">
    </div>
@endsection