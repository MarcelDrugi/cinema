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

const forCustomer = () => {
	const customers = document.getElementById('customers');
	const customerCheckBox = document.getElementById('customerCheckBox');
	if(customerCheckBox.checked == true) {
		customers.style.display = 'block';
	}
	else {
		customers.style.display = 'none';
	}
};

const showButton = (event) => {
	const discount = JSON.parse(event.target.value);
	const userIinfo = document.getElementById('userInfo');
	const delWarning = document.getElementById('delWarning');
	const delInfo = document.getElementById('delInfo');
	
	if(discount.user) {
		userInfo.innerHTML = discount.user.first_name + ' ' + discount.user.last_name + ' (' + discount.user.email + ')';
		delWarning.style.display = 'block';
		delInfo.style.display = 'none';
		//selectDiscount.value = discount.id;
	}
	else {
		delWarning.style.display = 'none';
		delInfo.style.display = 'block';
		//selectDiscount.value = discount.id;
	}
	
	const button = document.getElementById('deleteDiscount');
	button.style.display = 'block';
};
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

const activePricingButton = () => {
	document.getElementById('updatePricingButton').disabled = false;
}