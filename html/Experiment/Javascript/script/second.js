var create = document.querySelector('button');
create.addEventListener('click',createParagraph);

function createParagraph() {
	var para = document.createElement('p');
	para.textContent("Welocome to the world");
	document.body.appendChild(para);
}