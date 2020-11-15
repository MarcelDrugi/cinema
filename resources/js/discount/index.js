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