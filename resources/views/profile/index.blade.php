<script>
var loadFile = function(event) {
  	var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.height = 100;
    output.style.width = 100;
	output.onload = function() {
  		URL.revokeObjectURL(output.src) // free memory
	}
};
  
function newPass(checkbox) {
    if(checkbox.checked == true) {
        document.getElementById("newPass").style.display = "block";
    } 
    else {
        document.getElementById("newPass").style.display = "none";
    }
}
</script>


@extends('layouts.base')

@section('content')
	@if($action)
		@if($action == "newData")
			<div class="alert alert-success alert-dismissible" role="alert">
            	POMYŚLNIE ZMIENIONO DANE
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
		@endif
	@endif
	<form method="POST" action="{{ route('profile.update', ['profile' => $user->id]) }}" enctype="multipart/form-data">
		@csrf
		@method('PUT')
    	<div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Imię</label>

            <div class="col-md-6">
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ? old('first_name') : $user->first_name }}" required autocomplete="first_name" autofocus>

                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">Nazwisko</label>

            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ? old('last_name') : $user->last_name }}" required autocomplete="last_name" autofocus>

                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
            <div class="col-md-6">
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

            <div class="col-md-6">
                <input id="avatar" type="file" onchange="loadFile(event)" class="@error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" autofocus>
				<img id="output"/>
                @error('avatar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="changePass" class="col-md-4 col-form-label text-md-right">zmień hasło</label>
            <input type="checkbox" name="changePass" onchange="newPass(this)">
        </div>
        <div id="newPass" style="display: @if($errors->first('password')) block @else none @endif">
    		<div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                <div class="col-md-6">
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
    
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
        </div>
        <button type="submit">wyślij</button>
	</form>
	<h2> {{__('YOUR RESERVATIONS') }}: </h2>
	<div>
		@foreach($reservations as $reservation)
			<div>
			{{ $reservation->screening->movie->title }} ({{ __($reservation->screening->term->day()) }} - {{ date('d.m.Y - H:i', strtotime($reservation->screening->term->date_time)) }})
			@if($reservation->payment_status)
				<b style="color: green;"> opłacone </b>
			@else
				<b style="color: red;"> nie opłacone </b>
				<form action="{{ route('profile.store') }}" method="post">
					@csrf
					<input type="hidden" value="{{ $reservation->id }}" name="reservationId">
					<button type="submit">opłać</button>
				</form>
			@endif
			</div>
		@endforeach
	</div>
	<h2> {{__('YOUR DISCOUNTS') }}: </h2>
	<div>
		@foreach($discounts as $discount)
			<div>{{ $discount->code }} ({{ $discount->value * 100 }}%)</div>
		@endforeach
	</div>
@endsection