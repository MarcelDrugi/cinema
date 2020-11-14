const selectMovie = (event) => {
	const movie = JSON.parse(event.target.value);
	
	const details = document.getElementById('movieDetail');
	details.style.display = 'block'; 
	
	title.value = movie.title;
	description.value = movie.description;
	published.value = movie.published;
	
	if(movie.new_movie == 1) {
		new_movie.checked = true;
	}
	else {
		new_movie.checked = false;
	}
	
	time.value = movie.time;
	age_limit.value = movie.age_limit;
	id.value = movie.id;
	
	const poster = document.getElementById('poster-img');
	poster.src = movie.poster;
	poster.style.height = 100;
    poster.style.width = 100;
};

const loadFile = (event) => {
	let poster = null;
	if(event.target.id == 'poster') {
  		poster = document.getElementById('poster-img');
  	}
  	else if(event.target.id == 'newPoster') {
  		poster = document.getElementById('new-poster-img');
  	}
    poster.src = URL.createObjectURL(event.target.files[0]);
    poster.style.height = 100;
    poster.style.width = 100;
    poster.onload = function() {
      URL.revokeObjectURL(output.src)
    }
};

const newMovie = () => {
	const newMovieForm = document.getElementById('createMovie');
	const oldMovieForm = document.getElementById('editMovie');
	const editMovieCover = document.getElementById('editMovieCover');
	const newMovieSwitch = document.getElementById('newMovie');
	
	if(newMovieSwitch.checked == true) {
		newMovieForm.style.display = 'block';
		oldMovieForm.style.opacity = 0.4;
		editMovieCover.style.zIndex = 2;
	}
	else {
		newMovieForm.style.display = 'none';
		oldMovieForm.style.opacity = 1;
		editMovieCover.style.zIndex = -1;
	}
};
