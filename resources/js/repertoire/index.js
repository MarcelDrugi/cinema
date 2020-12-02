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
