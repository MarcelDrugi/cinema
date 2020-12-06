
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
