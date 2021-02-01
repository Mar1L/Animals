STYLE_TYPE = ["error", "ok", "normal"]; 
ERROR_MSG = ["can't be empty", "Name should only contain letters", "Passwords don't match", "Invalid e-mail", 
"You password must contain at least 7 characters", "Your password must contain at least one number", 
"Age must be grater than 0"];


//Sets the style of the field currently filled or checked
function setStyle(field, styleIndex){
	field.parentNode.setAttribute("class", STYLE_TYPE[styleIndex]);
	field.setAttribute("class", STYLE_TYPE[styleIndex]);
}

//Clears the style of a field 
function clearStyle(){
	var name = document.getElementById("name_error");
	var age = document.getElementById("age_error");
	var email = document.getElementById("email_error");
	var password = document.getElementById("password_error");
	var repassword = document.getElementById("repassword_error");
	
	setStyle(name, 2);
	setStyle(age, 2);
	setStyle(email, 2);
	setStyle(password, 2);
	setStyle(repassword, 2);

	clearErrors("name_error");
	clearErrors("age_error");
	clearErrors("email_error");
	clearErrors("password_error");
	clearErrors("repassword_error");
}

//Prints the current error and sets the style of the error message
function printError(type, styleIndex, errorIndex, msg = ""){
	var errorMessage = document.getElementById(type);
	errorMessage.textContent = msg + ERROR_MSG[errorIndex];
	errorMessage.setAttribute("class", STYLE_TYPE[styleIndex]);
}

//Deletes old error messages
function clearErrors(type){
	var error = document.getElementById(type);
	error.textContent = "";
}

//Checks if the name is only composed by letters
function checkName(buttonName) {
	var PERMITTED = /^[A-Za-z]+$/;
	var name = document.getElementById("name");
	var value = name.value.toString();
	var submit = document.getElementById(buttonName);
	
	if(value === ""){	//Blank
		submit.disabled = true;	//can't submit if fields are not properly filled
		printError("name_error", 0, 0, "Name ");
		setStyle(name, 0);
		return false;
	} else if(!value.match(PERMITTED)){	//Contains not permitted characters
		submit.disabled = true;
		printError("name_error", 0, 1);
		setStyle(name, 0);
		return false;
	} else {
		clearErrors("name_error");
		submit.disabled = false;
		setStyle(name, 1);
		return true;
	}
}

//Checks if the age field has been chosen
function checkAge(buttonName){
	var age = document.getElementById("age");
	var submit = document.getElementById(buttonName);
	if(age.value === ""){
		submit.disabled = true;	//can't submit if fields are not properly filled
		printError("age_error", 0, 0, "Age ");
		setStyle(age, 0);
		return false;
	} else if(age.value <= 0){
		submit.disabled = true;
		printError("age_error", 0, 6);
		setStyle(age, 0);
		return false;
	} else {
		clearErrors("age_error");
		submit.disabled = false;
		setStyle(age, 1);
		return true;
	}
}

//Checks if the email is in a valid format
function checkMail(buttonName) {
	//RFC 2822
	var PERMITTED = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9]?)*$/;
	var email = document.getElementById("email");
	var value = email.value;
	var submit = document.getElementById(buttonName);

	if(value === ""){
		submit.disabled = true;
		printError("email_error", 0, 0, "E-mail ");
		setStyle(email, 0);
		return false;
	} else if(!value.match(PERMITTED)){	//Handles error messages
		submit.disabled = true;
		printError("email_error", 0, 3);
		setStyle(email, 0);
		return false;
	} else {
		clearErrors("email_error");
		submit.disabled = false;
		setStyle(email, 1);
		return true;
	}
}

//Checks if the password is safe to use
function checkSecurity(buttonName) {
	var LETTERS = /^[A-Za-z]+$/;
	var password = document.getElementById("password");
	var value = password.value;
	var submit = document.getElementById(buttonName);

	if(value === ""){
		submit.disabled = true;
		printError("password_error", 0, 0, "Password ");
		setStyle(password, 0);
	} else if(value.length < 7){
		submit.disabled = true;
		printError("password_error", 1, 4);
		setStyle(password, 0);
		return false;
	} else if(value.match(LETTERS)) {	//Doesn't contain special characters
		submit.disabled = true;
		printError("password_error", 1, 5);
		setStyle(password, 0);
		return false;
	} else {
		clearErrors("password_error");
		submit.disabled = false;
		setStyle(password, 1);
		return true;
	}
}

//Checks if the two password fields match
function passwordsMatch(buttonName) {
	var password = document.getElementById("password");
	var repeat_password = document.getElementById("repeat_password");
	var submit = document.getElementById(buttonName);
	
	if(repeat_password.value === ""){
		submit.disabled = true;
		printError("repassword_error", 0, 0, "Password ");
		setStyle(repeat_password, 0);
	}else if(password.value !== repeat_password.value){
		submit.disabled = true;
		setStyle(repeat_password, 0);
		printError("repassword_error", 0, 2);
		return false;
	} else {
		clearErrors("repassword_error");
		submit.disabled = false;
		setStyle(repeat_password, 1);
		return true;
	}
}

function setVisibility(inputId, buttonId, visibility){
	var input = document.getElementById(inputId).style.visibility = visibility;
	var button = document.getElementById(buttonId).style.visibility = visibility;
}