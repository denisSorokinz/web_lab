function myFunction() {
	document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function (event) {
	if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			}
		}
	}
}

setMenu()
function setMenu() {
	const contentBlocks = document.querySelectorAll('.content__block');
	const menuButtons = document.querySelectorAll('.menu__button')
	menuButtons.forEach(button => {
		button.addEventListener("click", (event) => {
			menuButtons.forEach(btn => {
				btn === button
					? btn.classList.add('active')
					: btn.classList.remove('active')
			})
			contentBlocks.forEach(block => {
				block.id === button.dataset.block
					? block.classList.add('active')
					: block.classList.remove('active')
			})
		})
	})
}