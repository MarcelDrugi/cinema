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
