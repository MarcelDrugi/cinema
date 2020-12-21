const loadAvatar = (event) => {
	const avatar = document.getElementById('currentAvatar');
    avatar.src = URL.createObjectURL(event.target.files[0]);
    avatar.style.height = 120;
    avatar.style.width = 120;
    avatar.onload = () => {
		URL.revokeObjectURL(output.src)
	};
};