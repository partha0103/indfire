var myHeading = document.querySelector('h1');
myHeading.textContent = "Hello World";
var heading = document.querySelector('h1');
heading.addEventListener('resize', welcome);
function welcome() {
	alert("Welcome");
}