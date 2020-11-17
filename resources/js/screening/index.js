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