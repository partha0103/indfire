"use strict"
var error_element = false;

function isValidEmail() {
    var email_check = document.getElementById(arguments[0]).value.trim();
    var error_log = document.getElementById(arguments[1]);
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    if (!(re.test(email_check))) {
        error_log.style.display = 'block';
        error_log.textContent = "invalid email";
        error_element = false;
    } 
    else{
        error_log.style.display = "none";
        error_element = true;
    }
}


//Password validation 
function isValidPassword() {
    var passwordCheck = document.getElementById(arguments[0]).value;
    var error_log = document.getElementById(arguments[1]);
    var re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

    if (!(re.test(passwordCheck))) {
        error_log.style.display = 'block';
        error_log.textContent = "invalid password";
        error_element = true;
    }
    else{
        error_log.style.display = "none";
        error_element = false;  
    }
}


function isPasswordMatch(){
    var input1 = document.getElementById(arguments[0]).value;
    var input2 = document.getElementById(arguments[1]).value;
    var error_log = document.getElementById(arguments[2]);

    if (input1 !== input2) {
        error_log.style.display = "block";
        error_log.textContent = "password not matched";
        error_element = true;
    }
    else{
        error_log.style.display = "none";
        error_element = false;
    }
}

function isValidName(){
    var n = document.getElementById(arguments[0]).value.trim();
    var error = document.getElementById(arguments[1]);
    var regex =  /^[A-Za-z]+$/ ;

    if (!(regex.test(n))) {
        error.style.display = "block";
        error.textContent = "Invalid name format";
        error_element = true; 
    }
    else{
        error.style.display = "none";
        error_element = false;
    }
}

function isvalidZip() {
    var zip = document.getElementById(arguments[0]).value.trim();
    var error = document.getElementById(arguments[1]);
    var regex = /^\d{6}$/ ;
    if (!(regex.test(zip))) {
        error.style.display = "block";
        error.textContent = "Invalid zip";
        error_element = true; 
    }
    else{
        error.style.display = "none";
        error_element = false;   
    }
}

//Date of birth validation

function isValidDateOfBirth() {
    var date = document.getElementById(arguments[0]).value.split("-");
    var year = date[0];
    var month = date[1];
    var day = date[2];
    var error = document.getElementById(arguments[1]);
    var today = new Date();
    if ((today.getFullYear() - year) >= 18) {
        error.style.display = "none";
        error_element = false;
    }
    else{
        error.style.display = "block";
        error.textContent = "Age should be greater than 18";
        error_element = true; 
    }
}


function validateField() {
    var inputArray = document.getElementsByTagName('input');
    var inputField = false;
    for (var i = 0; i < inputArray.length; i++) {
        if (inputArray[i].value.trim() === "" && inputArray[i].getAttribute("required")) {
            inputField = true;
        }
    }
    
    if (error_element || inputField) {
        var div = document.getElementById('block-error').textContent = "Some fields are empty";
        //document.getElementById('submit').disabled = true;
        return false;
    }
    else {
        //document.getElementById('submit').disabled = false;
        return true;
    }
}
