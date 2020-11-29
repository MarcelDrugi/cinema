
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