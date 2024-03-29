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
	
	document.getElementById('timeGroup').style.display = 'flex';
	document.getElementById('termGroup').style.display = 'flex';
	document.getElementById('hallCheckBox').style.display = 'flex';
	
	modifyTerm.value = term.slice(8, 10) + '-' + term.slice(5, 7) + '-' + term.slice(0, 4);
	modifyTime.value = term.slice(11, 13) + ':' + term.slice(14, 16);
	
	forMovie.value = screening.movie_id;
};

const changeHall = () => {
	const newHall = document.getElementById('newHall');
	const selectHall = document.getElementById('changeHallSelect');
	
	if(newHall.checked == true) {
		selectHall.style.display = 'flex';
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

window.addEventListener('load', () => {
    document.getElementsByClassName('pageLoader')[0].style.display = 'none';
    document.getElementsByClassName('section')[0].style.visibility = 'visible';
    document.getElementsByClassName('footer')[0].style.visibility = 'visible';
    document.getElementsByClassName('hamburger')[0].style.visibility = 'visible';
});

const resize = () => {
	size = Math.floor(Math.random() * 200) - 100;
	return size;
};

const randomNumber  = (full, negative) => {
	return Math.floor(Math.random() * full) - negative;
}

const opacityAnimation = (dot, opacity, deg) => {
	if (opacity > 0) {
	
    	opacity -= .03;
    	if(deg < 0){
    		deg -= 4;
    	}
    	else {
    		deg += 4;
    	}
    	dot.style.opacity = opacity;
    	dot.style.transform = 'rotate(' + deg + 'deg)';
    	
    	setTimeout(function() {
			opacityAnimation(dot, opacity, deg);
		}, 16);
	}
	else {
		dot.remove();
	}
};

const disappearDot = (name, deg) => {
	let dot = document.getElementById(name);
	opacityAnimation(dot, 1, deg);
};

var dotId = 0;

const bar = (event) => {
	dotId  += 1;
	const name = dotId.toString();
	
	const top = event.pageY + resize();
	if(top + 117 < document.documentElement.scrollHeight) {
	
		let singleDot = document.createElement('div');
		singleDot.setAttribute('id', name);

		document.body.appendChild(singleDot);
		
		dot = document.getElementById(name);
		
		const deg = randomNumber(360, 180);
		
		dot.style.position = 'absolute';
		if(dotId % 2 == 0){
	    	dot.style.width = '49px';
	    	dot.style.height = '69px';
			dot.style.backgroundImage = "url('/images/shape1.png')";
		}
		else {
	    	dot.style.width = '75px';
	    	dot.style.height = '99px';
			dot.style.backgroundImage = "url('/images/shape2.png')";
		}
		dot.style.transform = 'rotate(' + deg + 'deg)';
		//dot.style.zIndex = '-1';
		dot.style.opacity = 0.3
	
		dot.style.left = (event.clientX + resize()) + 'px';
		dot.style.top = top + 'px';
	
		
		disappearDot(name, deg);
	}
};

const showHero = () => {
	const hero = document.getElementsByClassName('jumbotron')[0];

	if (hero.style.display == '' || hero.style.display == 'none') {
		hero.style.display = 'block';
		hero.classList.add('jumbotron-full');
	}
	else {
		hero.style.display = 'none';
		hero.classList.remove('jumbotron-full');
	}
	
};

var triangleAnimation = false;

const standartBackground = (id) => {
	triangleAnimation = false;
	
	const background = document.getElementsByClassName('heroBackground' + id)[0];
	background.classList.remove('heroBackground' + id);
	background.classList.add('heroBackground');
	setTimeout(function() {
		if(!triangleAnimation){
			const downTriangle = document.getElementsByClassName('downTriangleTransformed')[0];
			downTriangle.classList.remove('downTriangleTransformed');
			downTriangle.classList.add('downTriangle');
			
			const topTriangle = document.getElementsByClassName('topTriangleTransformed')[0];
			topTriangle.classList.remove('topTriangleTransformed');
			topTriangle.classList.add('topTriangle');
		}
	}, 700);
};

const newBackground = (id) => {
	triangleAnimation = true;
	
	const background = document.getElementsByClassName('heroBackground')[0];
	background.classList.remove('heroBackground');
	background.classList.add('heroBackground' + id);
	
	const downTriangle = document.getElementsByClassName('downTriangle')[0];
	downTriangle.classList.remove('downTriangle');
	downTriangle.classList.add('downTriangleTransformed');
	
	const topTriangle = document.getElementsByClassName('topTriangle')[0];
	topTriangle.classList.remove('topTriangle');
	topTriangle.classList.add('topTriangleTransformed');
};

window.addEventListener("mousemove", bar);


var posterId = 0;

const nextPoster = () => {
	
	if(!document.getElementsByClassName('poster' + (posterId + 2))[0]) {
		const button = document.getElementsByClassName('rightArrow')[0];
		button.disabled = true;
		button.classList.remove('rightArrow');
		button.classList.add('rightArrowStatic');
		
	}
	
	if(document.getElementsByClassName('poster' + (posterId + 1))[0]) {
    	const poster = document.getElementsByClassName('poster' + posterId)[0];
    	if(poster) {
    		poster.classList.add('rightHiddenPoster');
    		document.getElementById('posterMark' + posterId).checked = false;
    		document.getElementById('posterMark' + (posterId + 1)).checked = true;
    	}
    	
		posterId += 1;
		const newPoster = document.getElementsByClassName('poster' + posterId)[0];
		newPoster.classList.remove('beginHiddenPoster');
		newPoster.classList.remove('leftHiddenPoster');
		newPoster.classList.remove('leftShownPoster');
		newPoster.classList.add('rightShownPoster');
	}
	
	const button = document.getElementsByClassName('leftArrowStatic')[0];
	if(button) {
    	button.disabled = false;
    	button.classList.remove('leftArrowStatic');
    	button.classList.add('leftArrow');
    }
}

const previousPoster = () => {

	if(!document.getElementsByClassName('poster' + (posterId - 2))[0]) {
		const button = document.getElementsByClassName('leftArrow')[0];
		button.disabled = true;
		button.classList.remove('leftArrow');
		button.classList.add('leftArrowStatic');
	}

	if(document.getElementsByClassName('poster' + (posterId - 1))[0]) {
    	const poster = document.getElementsByClassName('poster' + posterId)[0];
    	if(poster) {
    		poster.classList.add('leftHiddenPoster');
    		document.getElementById('posterMark' + posterId).checked = false;
    		document.getElementById('posterMark' + (posterId - 1)).checked = true;
    	}
		posterId -= 1;
		const newPoster = document.getElementsByClassName('poster' + posterId)[0];
		newPoster.classList.remove('rightHiddenPoster');
		newPoster.classList.add('leftShownPoster');
	}
	
	const button = document.getElementsByClassName('rightArrowStatic')[0];
	if(button) {
    	button.disabled = false;
    	button.classList.remove('rightArrowStatic');
    	button.classList.add('rightArrow');
    }
}
const clearRepertoires = () => {
		[
			'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
            
		].forEach( (day) => {
			document.getElementById('rep' + day).style.display = 'none';
			document.getElementById('btn' + day).classList.remove('activeRepertoireBtn');
		});
	};
	
	
const chooseDay = (day) => {
	console.log(day);
	clearRepertoires();
	document.getElementById('rep' + day).style.display = 'block';
	document.getElementById('btn' + day).classList.add('activeRepertoireBtn');
};

document.addEventListener("DOMContentLoaded", function(){
    const today = new Date();
	const day = today.getDay();
	
	const classDiff = 4 - day;
	
	for(i=0; i<7; i++) {
		const card = document.getElementById('pricing' + i);
		card.classList.remove('pricingCard' + i);
		const classNr = i + classDiff;
		
		if(classNr > 6) {
			card.classList.add('pricingCard' + (classNr - 7));
		}
		else if(classNr < 0) {
			card.classList.add('pricingCard' + (classNr + 7));
		}
		else {
			card.classList.add('pricingCard' + classNr);
		}
	}
});

const pricingRight = () => {
	const lastCardName = 'pricingCard6';
	const lastCard = document.getElementsByClassName(lastCardName)[0];
	
	for(i=5; i>=0; i--) {
		const oldClassName = 'pricingCard' + i;
		const card = document.getElementsByClassName(oldClassName)[0];
		
		card.classList.remove(oldClassName);
		card.classList.remove('pricingMoveRight');
		card.classList.remove('pricingMoveLeft');
		
		card.offsetHeight;
		
		card.classList.add('pricingMoveRight');
		card.classList.add('pricingCard' + (i + 1));
	}
	
	lastCard.classList.remove(lastCardName);
	lastCard.classList.remove('pricingMoveRight');
	lastCard.classList.remove('pricingMoveLeft');
	
	lastCard.offsetHeight;
	
	lastCard.classList.add('pricingMoveRight');
	lastCard.classList.add('pricingCard0');
}

const pricingLeft = () => {
	const firstCardName = 'pricingCard0';
	const firstCard = document.getElementsByClassName(firstCardName)[0];
	
	for(i=1; i<7; i++) {
		const oldClassName = 'pricingCard' + i;
		const card = document.getElementsByClassName(oldClassName)[0];
		
		card.classList.remove(oldClassName);
		card.classList.remove('pricingMoveRight');
		card.classList.remove('pricingMoveLeft');
		
		card.offsetHeight;
		
		card.classList.add('pricingMoveLeft');
		card.classList.add('pricingCard' + (i - 1))
	}
	
	firstCard.classList.remove(firstCardName);
	firstCard.classList.remove('pricingMoveLeft');
	firstCard.classList.remove('pricingMoveRight');
	
	firstCard.offsetHeight;
	
	firstCard.classList.add('pricingMoveLeft');
	firstCard.classList.add('pricingCard6')
}


const newAvatar = (event) => {
  	const avatar = document.getElementById('changeAvatar');

  	avatar.style.display = 'inline';
    avatar.src = URL.createObjectURL(event.target.files[0]);
    avatar.style.height = '5vw';
    avatar.style.width = '5vw';

	avatar.onload = () => {
  		URL.revokeObjectURL(avatar.src)
	}
};
  
const newPass = (checkbox) => {
    if(checkbox.checked == true) {
        document.getElementById("newPass").style.display = "block";
    } 
    else {
        document.getElementById("newPass").style.display = "none";
    }
};

const loadAvatar = (event) => {
	const avatar = document.getElementById('currentAvatar');
    avatar.src = URL.createObjectURL(event.target.files[0]);
    avatar.style.height = 120;
    avatar.style.width = 120;
    avatar.onload = () => {
		URL.revokeObjectURL(output.src)
	};
};
const fillContent = (event) => {
	const info = JSON.parse(event.target.value);
	document.getElementById('enterContent').style.display = 'block';
	
	document.getElementById('content').value = info.content;
	range = info.max_length;
};

document.addEventListener("DOMContentLoaded", () => { 
    document.getElementById('content').addEventListener('keyup', function() {
        const value = this.value;
        if (value.length > range) {
            this.value = value.slice(0, range-1);
        } 
    });
});