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
