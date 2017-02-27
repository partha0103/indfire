
function validate() {
	console.log("hi");
	var tag = document.getElementsByTagName('input');
	for (var i = 0; i < tag.length; i++) {
		if (tag[i].value == "") {
			alert("validate input field");
		}
	}
}



function validateEmail() {
    var email_check = document.getElementById('inputEmail').value;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var f =re.test(email_check);
    console.log(f);
}

