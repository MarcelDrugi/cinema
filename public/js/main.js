const currentSumOfTickets = () => {
	const normal = document.getElementById('normalTickets').value;
	const junior = document.getElementById('juniorTickets').value;
	const senior = document.getElementById('seniorTickets').value;
	
	return parseInt(normal) + parseInt(junior) + parseInt(senior);
};

const increment = (id) => {
	let tickets = document.getElementById(id);
	if(currentSumOfTickets() < tickets.max) {
		tickets.value = parseInt(tickets.value) + 1;
	}
};

const decrement = (id) => {
	let tickets = document.getElementById(id);
	if(tickets.value > 0) {
		tickets.value = parseInt(tickets.value) - 1;
	}
};

const valid = (event) => {
	const sumOfTickets = currentSumOfTickets();
	
	let tickets = document.getElementById(event.target.id);
	const max = parseInt(tickets.max);
	
	if(isNaN(event.target.value) || event.target.value < 0) {
		tickets.value = 0;
		let alert = document.getElementById('typeOfTicketsNumber');
		alert.style.display = 'block';
	} else if(sumOfTickets > max) {
		tickets.value = max - (sumOfTickets - tickets.value);
	}
};

const takeRadioValue = (radioName) => {
	const radios = document.getElementsByName(radioName);

    for (let i = 0, length = radios.length; i < length; i++) {
    	if (radios[i].checked) {
			const discountId = document.getElementById('discountId');
			discountId.value = radios[i].id;
    		return radios[i].value;
      }
    }
};

const display = (normalPrice, juniorPrice, seniorPrice) => {
	const normalCount = document.getElementById('normalTickets').value;
	const juniorCount = document.getElementById('juniorTickets').value;
	const seniorCount = document.getElementById('seniorTickets').value;
	
	const sum = parseInt(normalPrice) * parseInt(normalCount) + parseInt(juniorPrice) * parseInt(juniorCount) + parseInt(seniorPrice) * parseInt(seniorCount);
	const sumWithDiscount = sum * (1.0 - parseFloat(takeRadioValue('discountRadio')));
	
	const display = document.getElementById('pay');
	
	display.innerHTML = sumWithDiscount.toFixed(2);
};

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
	console.log(event.target.id);
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
