<script>

const fillContent = (event) => {
	const info = JSON.parse(event.target.value);
	document.getElementById('enterContent').style.display = 'block';
	
	document.getElementById('content').value = info.content;
	range = info.max_length;
}

document.addEventListener("DOMContentLoaded", () => { 
    document.getElementById('content').addEventListener('keyup', function() {
        const value = this.value;
        if (value.length > range) {
            this.value = value.slice(0, range-1);
        } 
    });
});

</script>

@extends('layouts.base')

@section('content')
	@if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
      	<b>{{ __('EDIT ERROR') }}</b>
        <ul>
            @foreach (array_unique($errors->all()) as $error)
               <li>{{ ucfirst($error) }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
      </div>
	@endif
	@if($infoModified)
		<div class="alert alert-success alert-dismissible" role="alert">
        	{{ __('Information has been modified') }}: <b>{{ __($infoModified) }}</b>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@endif
	<div class="employeePanelNav">
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link" href="{{ route('movie.index') }}">{{ __('edit movie') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('discount.index') }}">{{ __('discounts') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('screening.index') }}">{{ strtolower(__('SCREENINGS')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('modify-pricing.index') }}">{{ strtolower(__('PRICINGS')) }}</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('information.index') }}">{{ strtolower(__('public content')) }}</a></li>
		</ul>
	</div>
	<div class="empoloyeeInformationTitle">{{ __('ENTER CONTENT FOR THE SUBPAGE SECTION') }}</div>
	<div class="employeeInformation">
    	<form method="post" action="{{ route('information.update') }}">
        	@csrf
        	@method('PUT')
        	<div class="form-group row">
            	<label for="infoSelect"> {{ __('Subpages') }}: </label>
            	<select class="form-control" id="infoSelect" name="infoSelect" onchange="fillContent(event)">
            		<option selected="selected" disabled value="">{{ __('select the subpage section') }}</option>
            		@foreach($infos as $info)
                  		<option value="{{ $info }}">{{ __($info->place) }}</option>
                  	@endforeach
                </select>
        	</div>
        	<div id="enterContent" style="display: none;">
        		<label for="content">{{ __('Enter the content') }}:</label>
        		<textarea class="form-control" id="content" name="content" value=""> </textarea>
        		<button class="btn btn-success" type="submit">{{ __('ACCEPT') }}</button>
        	</div>
    	</form>
    </div>

@endsection