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
