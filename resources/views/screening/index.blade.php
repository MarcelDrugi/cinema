<script>

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById('term').addEventListener('keyup', function() {
        const value = this.value;
        if (value.match(/^\d{2}$/) !== null) {
            this.value = value + '-';
        }
        else if (value.match(/^\d{2}\-\d{2}$/) !== null) {
            this.value = value + '-';
        }
    });
    
    document.getElementById('time').addEventListener('keyup', function() {
        const value = this.value;
        if (value.match(/^\d{2}$/) !== null) {
            this.value = value + ':';
        } 
    });
});

const parseDate = (strDate) => {
	return new Date(
		strDate.slice(0, 4),
		strDate.slice(5, 7) - 1,
		strDate.slice(8, 10),
		strDate.slice(11, 13),
		strDate.slice(14, 16)
	);
}

const calculateDate = (date, time) => {
	const baseDate = parseDate(date);
	const finalTimestamp = baseDate.getTime() + time * 60000;
	const finalDate = new Date(finalTimestamp);

	return[baseDate, finalDate];
};

const formatDate = (date) => {
	finalStr = '' + 
		('0' + date.getDate()).slice(-2) + 
		'.' + 
		('0' + (date.getMonth()+1)).slice(-2) +
		'   ' + 
		('0' + date.getHours()).slice(-2) +
		':' +
		('0' + date.getMinutes()).slice(-2);
		
	return finalStr;
};

const unableButton = () => {
	if(datesForHallSelect.value != '' && movieForScreeningSelect.value != '') {
		document.getElementById('confirmNewScreeningButton').disabled = false;
	}
};

const existingScreenings = (event) => {
	unableButton();
	const movie = JSON.parse(event.target.value);
	movie.screenings.sort((a, b) => parseDate(a.term.date_time) - parseDate(b.term.date_time));
	
	document.getElementById('screeningsInfo').style.display = 'block';
	const screenings = document.getElementById('existingScreenings');
	
	screenings.innerHTML = "<ul>";
	movie.screenings.forEach((element) => {
		screenings.innerHTML += '<li>' + formatDate(parseDate(element.term.date_time)) + '</li>';
	});
	screenings.innerHTML += "</ul>";
};

const bookedDates = (event) => {
	unableButton();
	const hall = JSON.parse(event.target.value);
	hall.terms.sort((a, b) => parseDate(a.date_time) - parseDate(b.date_time));
	
	const terms = document.getElementById('bookedDates');
	document.getElementById('bookingsInfo').style.display = 'block';
	
	terms.innerHTML = "<ul>";
	hall.terms.forEach((element) => {
		dates = calculateDate(element.date_time, element.screening.movie.time);
		terms.innerHTML += '<li>' + 
			formatDate(dates[0]) + 
			'  -  ' + 
			formatDate(dates[1]) + 
			'</li>';
	});
	terms.innerHTML += "</ul>";
};

const modifyScreening = (event) => {
	const screening = JSON.parse(event.target.value);
	term = screening.term.date_time;

	document.getElementById('confirmScreeningEdition').disabled = false;
	document.getElementById('deleteScreeningEdition').disabled = false;
	
	document.getElementById('timeGroup').style.display = 'block';
	document.getElementById('termGroup').style.display = 'block';
	document.getElementById('hallCheckBox').style.display = 'block';
	
	console.log(screening);
	
	modifyTerm.value = term.slice(8, 10) + '-' + term.slice(5, 7) + '-' + term.slice(0, 4);
	modifyTime.value = term.slice(11, 13) + ':' + term.slice(14, 16);
	
	forMovie.value = screening.movie_id;
};

const changeHall = () => {
	const newHall = document.getElementById('newHall');
	const selectHall = document.getElementById('changeHallSelect');
	
	if(newHall.checked == true) {
		selectHall.style.display = 'block';
	}
	else {
		selectHall.style.display = 'none';
	}
};

const bookedDatesEdit = (event) => {
	const hall = JSON.parse(event.target.value);
	hall.terms.sort((a, b) => parseDate(a.date_time) - parseDate(b.date_time));
	
	const terms = document.getElementById('bookedDatesEdit');
	document.getElementById('bookingsInfoEdit').style.display = 'block';
	
	terms.innerHTML = "<ul>";
	hall.terms.forEach((element) => {
		dates = calculateDate(element.date_time, element.screening.movie.time);
		terms.innerHTML += '<li>' + 
			formatDate(dates[0]) + 
			'  -  ' + 
			formatDate(dates[1]) + 
			'</li>';
	});
	terms.innerHTML += "</ul>";
};

</script>

@extends('layouts.base')

@section('content')
	<div>
    	<ul class="nav nav-tabs">
    		<li class="nav-item"><a class="nav-link" href="{{ route('movie.index') }}">{{ __('edit movie') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('discount.index') }}">{{ __('discounts') }}</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('screening.index') }}">{{ strtolower(__('SCREENINGS')) }}</a></li>
    	</ul>
    </div>
     @if($newScreening)
		<div class="alert alert-success alert-dismissible" role="alert">
        	{{ __('A new screening was created for') }} <b>{{ $newScreening }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@elseif($deletedScreening)
		<div class="alert alert-success alert-dismissible" role="alert">
        	{{ __('Removed movie screening') }}: <b>{{ $deletedScreening }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
    @elseif($screeningEdited)
		<div class="alert alert-success alert-dismissible" role="alert">
        	<b>{{ __('Screening modified.') }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@endif
	<h2> {{ __('SCREENINGS') }}</h2>
	<h4> {{ __('Create screening') }} </h4>
	<div class="col-md-8">
    	<form method="post" action="{{ route('screening.store') }}">
    		@csrf
           
            <div class="form-group row">
                <label for="term" class="col-md-4 col-form-label text-md-right">{{ __('term') }}</label>

                <div class="col-md-6">
                    <input id="term" name="term" type="text" placeholder="{{ __('DD-MM-YYY') }}" maxlength="10" class="form-control @error('term') is-invalid @enderror" value="{{ old('term') }}" required >

                    @error('term')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('time') }}</label>

                <div class="col-md-6">
                    <input id="time" name="time" type="text" placeholder="{{ __('HH:MM') }}" maxlength="5" class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}" required >

                    @error('time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            
    		<div class="form-group row">
            	<label for="movieForScreeningSelect"> {{ __('Movies') }}: </label>
            	<select class="form-control" id="movieForScreeningSelect" name="movieForScreeningSelect" onchange="existingScreenings(event)">
            		<option selected="selected" disabled value="">{{ __('select movie') }}</option>
            		@foreach($movies as $movie)
                  		<option value="{{ $movie }}">{{ $movie->title }} ({{ $movie->published }})</option>
                  	@endforeach
                </select>
    		</div>
    		<div class="form-group row">
            	<label for="datesForHallSelect"> {{ __('Halls') }}: </label>
            	<select class="form-control" id="datesForHallSelect" name="datesForHallSelect" onchange="bookedDates(event)">
            		<option selected="selected" disabled value="">{{ __('select hall') }}</option>
            		@foreach($halls as $hall)
                  		<option value="{{ $hall }}">{{ $hall->name }} ({{ $hall->capacity }})</option>
                  	@endforeach
                </select>
    		</div>
    		<button id ="confirmNewScreeningButton" type="submit" disabled>{{ __('ACCEPT') }}</button>
    	</form>
	</div>
	<div id="screeningsInfo" style="display: none;">
		{{ __('Existing screenings of this movie') }}
	</div>
	<div id="existingScreenings"></div>
	
	<div id="bookingsInfo" style="display: none;">
		{{ __('Dates not available for this hall') }}
	</div>
	<div id="bookedDates"></div>
	<br><br><br><br><br>
	<h4> {{ __('Modify screening') }} </h4>
	
	<div class="col-md-8">
		<form method="post">
    		@csrf
    		@method('PUT')
    		<div class="form-group row">
            	<label for="movieForEditScreening"> {{ __('Movies') }}: </label>
            	<select class="form-control" id="movieForEditScreening" name="movieForEditScreening" onchange="modifyScreening(event)">
            		<option selected="selected" disabled value="">{{ __('select screening') }}</option>
            		@foreach($movies as $movie)
            			@foreach($movie->screenings as $screening)
                  			<option value="{{ $screening }}">{{ $movie->title }} ({{ date( 'd/m - H:i', strtotime($screening->term->date_time)) }})</option>
                  		@endforeach
                  	@endforeach
                </select>
    		</div>
			<div class="form-group row" id="termGroup" style="{{ old('modifyTerm') ? 'display: block;' : 'display: none;' }}">
                <label for="modifyTerm" class="col-md-4 col-form-label text-md-right">{{ __('term') }}</label>

                <div class="col-md-6">
                    <input id="modifyTerm" name="modifyTerm" type="text" placeholder="{{ __('DD-MM-YYY') }}" maxlength="10" class="form-control @error('modifyTerm') is-invalid @enderror" value="{{ old('modifyTerm') }}" required >

                    @error('modifyTerm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row" id="timeGroup" style="{{ old('modifyTime') ? 'display: block;' : 'display: none;' }}">
                <label for="modifyTime" class="col-md-4 col-form-label text-md-right">{{ __('time') }}</label>

                <div class="col-md-6">
                    <input id="modifyTime" name="modifyTime" type="text" placeholder="{{ __('HH:MM') }}" maxlength="5" class="form-control @error('modifyTime') is-invalid @enderror" value="{{ old('modifyTime') }}" required >

                    @error('modifyTime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div id="hallCheckBox" class="custom-control custom-switch" style="display: none">
            	<input type="checkbox" class="custom-control-input" id="newHall" onchange="changeHall()">
            	<label class="custom-control-label" for="newHall">{{ __('change hall') }}</label>
            </div>
            <div id="changeHallSelect" class="form-group row" style= "display: none;">
            	<label for="changedHall"> {{ __('Halls') }}: </label>
            	<select class="form-control" id="changedHall" name="changedHall" onchange="bookedDatesEdit(event)" value="{{ old('changedHall') ? old('changedHall') : ''}}">
            		<option selected="selected" disabled value="">{{ __('select hall') }}</option>
            		@foreach($halls as $hall)
                  		<option value="{{ $hall }}">{{ $hall->name }} ({{ $hall->capacity }})</option>
                  	@endforeach
                </select>
    		</div>
    		<input type="hidden" name="forMovie" id="forMovie">
    		<button formaction="{{ route('screening.update') }}" id ="confirmScreeningEdition" type="submit" disabled>{{ __('EDIT') }}</button>
    		<button formaction="{{ route('screening.destroy') }}" id ="deleteScreeningEdition" type="submit" disabled>{{ __('DELETE') }}</button>
    	</form>
    	<div id="bookingsInfoEdit" style="display: none;">
    		{{ __('Dates not available for this hall') }}
    	</div>
    	<div id="bookedDatesEdit"></div>
	</div>
@endsection

