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