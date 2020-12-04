@extends('layouts.base')

@section('content')
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
	<div class="employeePanelNav">
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" href="{{ route('movie.index') }}">{{ __('edit movie') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('discount.index') }}">{{ __('discounts') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('screening.index') }}">{{ strtolower(__('SCREENINGS')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('modify-pricing.index') }}">{{ strtolower(__('PRICINGS')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('information.index') }}">{{ strtolower(__('public content')) }}</a></li>
		</ul>
	</div>
	<div class="employeeMovieTitle">{{ __('EDITING MOVIES') }} </div>
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
            <div id="movieDetail" style="display:none" class="employeeMovieDetail">
            	<div class="employeeMovieDetailBackground"></div>
            	<div class="employeeMovieGroup">
                	<label for="title">{{ __('Title') }}: </label>
                	<input type="text" id="title" name="title">
                </div>
            	
            	<div class="employeeMovieGroup">
                	<label for="description">{{ __('Description') }}: </label>
                	<textarea id="description" name="description"></textarea>
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="published">{{ __('Year of the premiere') }}: </label>
                	<input type="text" id="published" name="published">
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="new_movie">{{ __('New movie') }}: </label>
                	<input type="checkbox" id="new_movie" name="new_movie">
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="time">{{ __('Duration') }}: </label>
                	<input type="text" id="time" name="time">
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="age_limit">{{ __('Age limit') }}: </label>
                	<input type="text" id="age_limit" name="age_limit">
                </div>
            	
            	<div class="employeeMovieGroup">
                	<label for="poster">{{ __('Poster') }}: </label>
                	<input id="poster" type="file" onchange="loadFile(event)" name="poster" autofocus>
        			<div>
        				<img id="poster-img" />
        			</div>
    			</div>
            	
            	<input type="hidden" id ="id" name="id">
            	<div class="employeeMovieButtons">
            		<button class="btn btn-warning" type="submit" formaction="{{ route('movie.update') }}">{{ __('EDIT') }}</button>
            		<button class="btn btn-danger" type="submit" formaction="{{ route('movie.destroy') }}">{{ __('DELETE') }}</button>
        		</div>
        	</div>
    	</form>
	</div>
	<div class="employeeNewMovie">
		<div class="custom-control custom-switch custom-switch-lg">
        	<input type="checkbox" class="custom-control-input" id="newMovie" onchange="newMovie()">
        	<label class="custom-control-label" for="newMovie">{{ __('create new movie') }}</label>
        </div>
    </div>
    
    <div class="newMovie">
        <form method="post" id="createMovie" enctype="multipart/form-data" style="display: none;">
        	@csrf
        	<div class="employeeMovieDetail">
        		<div class="employeeMovieDetailBackground"></div>
            	<div class="employeeMovieGroup">
                	<label for="newTitle">{{ __('Title') }}: </label>
                	<input type="text" id="newTitle" name="newTitle">
                </div>
            	
            	<div class="employeeMovieGroup">
                	<label for="newDescription">{{ __('Description') }}: </label>
                	<input type="text" id="newDescription" name="newDescription">
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="newPublished">{{ __('Year of the premiere') }}: </label>
                	<input type="text" id="newPublished" name="newPublished">
                </div>
            	
            	<div class="employeeMovieGroup">
                	<label for="newNew_movie">{{ __('New movie') }}: </label>
                	<input type="checkbox" id="newNew_movie" name="newNew_movie">
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="newTime">{{ __('Duration') }}: </label>
                	<input type="text" id="newTime" name="newTime">
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="newAge_limit">{{ __('Age limit') }}: </label>
                	<input type="text" id="newAge_limit" name="newAge_limit">
            	</div>
            	
            	<div class="employeeMovieGroup">
                	<label for="newPoster">{{ __('Poster') }}: </label>
                	<input id="newPoster" type="file" onchange="loadFile(event)" class="@error('poster') is-invalid @enderror" name="newPoster" autofocus>
                	<div>
            			<img id="new-poster-img"/>
            		</div>
        		</div>
        		
            	<input type="hidden" id ="newId" name="newId">
            	<div class="employeeMovieButtons">
        			<button type="submit" class="btn btn-success" formaction="{{ route('movie.store') }}">{{ __('ADD') }}</button>
        		</div>
    		</div>
    	</form>
    </div>
@endsection