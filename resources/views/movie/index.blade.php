@extends('layouts.base')

@section('content')
	<div>
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" href="{{ route('movie.index')}}">{{ __('edit movie') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Menu 1</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Menu 2</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Menu 3</a></li>
		</ul>
	</div>
	@isset($action)
		@if($action == "movieEdited")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('FILM EDITED SUCCESSFULLY') }}
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
		@elseif($action == "movieDeleted")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('MOVIE DELETED SUCCESSFULLY') }}
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
        @elseif($action == "newMovie")
			<div class="alert alert-success alert-dismissible" role="alert">
            	{{ __('NEW MOVIE ADDED TO THE DATA BASE') }}
            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
            	</button>
            </div>
		@endif
	@endif
	@if(old('title') || old('description') || old('published') ||  old('age_limit') || old('new_movie') || old('time') || old('poster'))
    	<div class="alert alert-danger alert-dismissible" role="alert">
        	{{ __('EDIT ERROR') }}
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@endif
	@if(old('newTitle') || old('newDescription') || old('newPublished') ||  old('newAge_limit') || old('newNew_movie') || old('newTime') || old('newPoster'))
    	<div class="alert alert-danger alert-dismissible" role="alert">
        	{{ __('ERROR WHILE MAKING MOVIE') }}
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
	@endif
	@if ($errors->any())
  <div class="alert alert-danger alert-dismissible">
    <ul>
        @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
	<h3>{{ __('EDITING MOVIES') }} </h3>
	<div class="editMovie">
    	<div id="editMovieCover" class="movieCover"></div>
    	<form method="post" enctype="multipart/form-data" id="editMovie">
        	@csrf
        	@method('PUT')
        	<label for="movie"> {{ __('Select the video you want to edit / delete') }}: </label>
        	<select class="form-control" name="movie" id="movie" onchange="selectMovie(event)">
        		<option selected="selected" disabled>{{ __('select movie') }}</option>
        		@foreach($movies as $movie)
              		<option value="{{ $movie }}">{{ $movie->title }}</option>
              	@endforeach
            </select>
            <div id="movieDetail" style="display:none">
            	<label for="title">{{ __('Title') }}: </label>
            	<input type="text" id="title" name="title">
            	
            	<label for="description">{{ __('Description') }}: </label>
            	<input type="text" id="description" name="description">
            	
            	<div class="form-group row">
                	<label for="published">{{ __('Year of the premiere') }}: </label>
                	<input type="text" id="published" name="published">
            	</div>
            	
            	<label for="new_movie">{{ __('New movie') }}: </label>
            	<input type="checkbox" id="new_movie" name="new_movie">
            	
            	<label for="time">{{ __('Duration') }}: </label>
            	<input type="text" id="time" name="time">
            	
            	<div class="form-group row">
                	<label for="age_limit">{{ __('Age limit') }}: </label>
                	<input type="text" id="age_limit" name="age_limit">
                </div>
            	
            	<label for="poster">{{ __('Poster') }}: </label>
            	<input id="poster" type="file" onchange="loadFile(event)" name="poster" autofocus>
    			<img id="poster-img" />
            	
            	<input type="hidden" id ="id" name="id">
            	
        		<button type="submit" formaction="{{ route('movie.update') }}">{{ __('EDIT') }}</button>
        		<button type="submit" formaction="{{ route('movie.destroy') }}">{{ __('DELETE') }}</button>
        	</div>
    	</form>
	</div>
	<div class="custom-control custom-switch">
    	<input type="checkbox" class="custom-control-input" id="newMovie" onchange="newMovie()">
    	<label class="custom-control-label" for="newMovie">{{ __('create new movie') }}</label>
    </div>
    
    <form method="post" id="createMovie" enctype="multipart/form-data" style="display: none;">
    	@csrf
    	<label for="newTitle">{{ __('Title') }}: </label>
    	<input type="text" id="newTitle" name="newTitle">
    	
    	<label for="newDescription">{{ __('Description') }}: </label>
    	<input type="text" id="newDescription" name="newDescription">
    	
    	<label for="newPublished">{{ __('Year of the premiere') }}: </label>
    	<input type="text" id="newPublished" name="newPublished">
    	
    	<label for="newNew_movie">{{ __('New movie') }}: </label>
    	<input type="checkbox" id="newNew_movie" name="newNew_movie">
    	
    	<label for="newTime">{{ __('Duration') }}: </label>
    	<input type="text" id="newTime" name="newTime">
    	
    	<label for="newAge_limit">{{ __('Age limit') }}: </label>
    	<input type="text" id="newAge_limit" name="newAge_limit">
    	
    	<label for="newPoster">{{ __('Poster') }}: </label>
    	<input id="newPoster" type="file" onchange="loadFile(event)" class="@error('poster') is-invalid @enderror" name="newPoster" autofocus>
		<img id="new-poster-img"/>
    	
    	<input type="hidden" id ="newId" name="newId">
    	
		<button type="submit" formaction="{{ route('movie.store') }}">{{ __('ADD') }}</button>
	</form>

@endsection