document.addEventListener("DOMContentLoaded", () => {
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
})