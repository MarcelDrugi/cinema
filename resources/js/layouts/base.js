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
		dot.style.display = 'none';
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
	if(top + 100 < document.documentElement.scrollHeight) {
	
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

window.addEventListener("mousemove", bar);
