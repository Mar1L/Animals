STYLE_TYPE = ["correct", "wrong"];
ANIMAL = new Array();
index = 0;
URL = null;
SCORE = 0;
ERRORS = 0;
HELP = 4;
CURRENT_HELP = 0;
LIVES = 2;
LEVEL = 1;
TIMER = null;
LEVEL_TIME = 30;
SAVED_TIME = 0;
CHECKED = false;
counter = 0;
TOTAL_SCORE = 0;

//Prints a fast how-to-play guide and a button to start the game
function howToPlay(){
	var father = document.getElementsByTagName("main");
	var title = document.createElement("h2");
	var text = document.createTextNode("How to Play");
	title.appendChild(text);
	father[0].appendChild(title);
	var p = document.createElement("p");
	text = document.createTextNode("Write the name of the animal you see in the picture in the given time, " + 
		"you can use 5 helps. If you use more helps or can't make it on time you will lose one of your 3 lives. " + 
		"Give you answer as fast as you can, if you are fast enough you will get an extra life. Click Play to start!");
	p.appendChild(text);
	p.setAttribute("id", "howToPlay");
	father[0].appendChild(p);
	var start = document.createElement("input");
	start.setAttribute("id", "start");
	start.setAttribute("type", "button");
	start.setAttribute("value", "Start!");
	start.setAttribute("onclick", "start()");
	start.setAttribute("class", "button");
	father[0].appendChild(start);
}

//Gets an animal for the game. Every animal needs to be different from the previous ones, the length of its name
//is increased by one every 3 animals or when there are no more animals of theat length to display.
function getAnimal(){
	var xmlHttp = new XMLHttpRequest();
	
	xmlHttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var [animal, url] = this.responseText.split(" ", 2);
			if(animal == 0){	//no name of the given length
				newLevel(0);
				getAnimal();
			} else if(animal == 1){	//max length of the name reached
				gameOver(1);
			} else if(noRepetitions(animal)){	//name different from the previous one
				counter = 0;
				ANIMAL[index] = animal.toString();
				URL = url.toString();
				buildScenario();
			} else if(counter == 2){	//same name for 3 times, i assume there is only 1 
				newLevel(0);
				getAnimal();
			} else {	//got same name, try again 
				counter++;
				getAnimal();
			}
		}
	};
	
	xmlHttp.open("GET", "createGame.php?dim=" + (LEVEL + 2), true);
	xmlHttp.send();
}

//Checks if the animal is new to the current game
function noRepetitions(animal){
	for(var i = 0; i < index; i++){
		if(animal === ANIMAL[i]){
			return false;
		}
	}
	return true;
}

//Cleans the array of animals every time the length increases
function emptyAnimals(){
	ANIMAL = new Array();
	index = 0;
}

//Increments LEVEL
function newLevel(check){
	if (check == 0){	//no checks
		document.getElementById("level").innerHTML = ++LEVEL;
		emptyAnimals();
	} else if(index == 3){	//checks the index (max 3 animals per level)
		document.getElementById("level").innerHTML = ++LEVEL;
		emptyAnimals();
	}	
}

//Adds an animal to the game
function buildScenario(){
	var game_wrapper = document.getElementById("main");
	var div = document.createElement("div");
	var image = document.createElement("img");
	var text = document.createElement("input");
	var check = document.createElement("input");
	var help = document.createElement("input");
	var message = document.createElement("div");

	image.src = URL;
	image.alt = ANIMAL[index];

	//Input form the user
	text.setAttribute("type", "text");
	text.setAttribute("class", "text_input");
	text.addEventListener('keypress', function (e) {
	    if (e.key === 'Enter') {
	      checkName();
	    }
	});
		
	//Button to check if the input is correct
	check.setAttribute("type", "button");
	check.setAttribute("id", "check");
	check.setAttribute("value", "Check");
	check.setAttribute("onclick", "checkName()");
	check.setAttribute("class", "button");
	check.setAttribute("class", "game_button");
	
	//Button to autocomplete or correct the input
	help.setAttribute("type", "button");
	help.setAttribute("id", "help");
	help.setAttribute("value", "Help");
	help.setAttribute("onclick", "helpFunction()");
	help.setAttribute("class", "button");
	help.setAttribute("class", "game_button");
	
	message.appendChild(help);
	message.appendChild(check);
	message.setAttribute("id", "message");

	div.setAttribute("id", ANIMAL[index]);
	div.appendChild(image);
	div.appendChild(text);
	div.appendChild(message);
	
	game_wrapper.appendChild(div);

	index++;
}

//Starts the game
function start() {
	//removes how to play 
	removeElements("main");
	//score and timer become visible	
	setVisibility("time", "visible");
	setVisibility("score_form", "visible");	
	setVisibility("leveldiv", "visible");
	//gets the animal
	getAnimal();
	//starts the timer
	TIMER = setInterval("timer()", 1000);
}

//Makes the an element visible
function setVisibility(id, value) {
	var element = document.getElementById(id);
	element.style.visibility = value;
}

//Enables or disables a button
function updateButtonStatus(id, value) {
	var button = document.getElementById(id);
	button.disabled = value;
}

//Writes the next letter or corrects the first wrong one, help button on click
function helpFunction() {
	var input = findElement("text");
	var value = input.value;
	var id = input.parentNode.id;
	var tmp;
	if(input.value.charAt(0) === "") {	//empty field
		input.value += id.charAt(0);
		CURRENT_HELP++;
		helpCounter();
		return;
	} else {
		for(var i = 0; i < value.length; i++){
			if (value.charAt(i) !== id.charAt(i)) {//wrong letter
				input.value = setCharAt(input.value, i, id.charAt(i));
				CURRENT_HELP++;
				helpCounter();
				return;
			} else if ( (value.length < id.length) && (value.charAt(i+1) === "") ) {//incomplete word
				input.value += id.charAt(i+1);	//adding next letter
				CURRENT_HELP++;
				helpCounter();
				return;
			}
		}
	}
}

//Decrements HELP; if there are no more helps decrements LIVES
function helpCounter(){
	if(HELP > 0)
		updateStats(0, "helps");
	else
		updateStats(0, "lives");
}

//Checks if the name inserted by the user is correct, check button on click
function checkName() {
	var input = findElement("text");
	var name = input.parentNode.id;
	var value = input.value.toLowerCase();
	var b = bonus();
	if(b)
		b = " You are fast! You got an extra life!";
	else
		b = "";		
	if(name === ""){
		input.setAttribute("class", "wrong");
		updateStats(LEVEL + 2, "score");
		writeMessage("The correct answer is: " + name + b);
	} else if(name === value) {
		input.setAttribute("class", "correct");
		updateStats(name.length - CURRENT_HELP, "score");
		writeMessage("Your answer is correct!" + b);
	} else {
		input.setAttribute("class", "wrong");
		var errors = calculateErrors(name, value);
		updateStats(name.length - errors - CURRENT_HELP, "score");
		writeMessage("The correct answer is: " + name + b);
	}

	newLevel(1);
	clearInterval(TIMER);
	addNextButton();
	TOTAL_SCORE += name.length;
	CHECKED = true;	//the name has been checked already
}

//Checks how much time the user has saved, gives an extra life every 45 seconds saved
function bonus(){
	SAVED_TIME += parseInt(document.getElementById("timer").value);
	if(SAVED_TIME >= 45){
		updateStats("1", "lives");
		SAVED_TIME = 0;
		return true;
	}
	return false;
}

function writeMessage(msg){
	var message = document.getElementById("message");
	message.removeChild(message.childNodes[0]);
	message.removeChild(message.childNodes[0]);
	var p = document.createElement("p");
	text = document.createTextNode(msg);
	p.appendChild(text);
	message.appendChild(p);
}

//Counts how many characters in the name of the animal are wrong
function calculateErrors(name, input){
	var counter = 0;
	for(var i = 0; i < name.length; i++){
		if (name.charAt(i) !== input.charAt(i))
			counter++;
	}
	updateStats(counter, "errors");
	return counter;
}

//Updates the values of LIVES, HELP, SCORE and ERRORS in the global variables and game  
function updateStats(newValue, name) {
	var stats = document.getElementById("score_span");
	switch(name){
		case "lives":
			if(LIVES > 0){
				if(newValue == 0)
					stats.childNodes[3].value = --LIVES;
				else
					stats.childNodes[3].value = ++LIVES;
			} else {
				gameOver(0);
			}
			break;
		case "helps":
			stats.childNodes[7].value = --HELP;
			break;
		case "score":
			SCORE += newValue;	//updates global variable
			stats.childNodes[11].value = SCORE;
			break;
		case "errors":
			ERRORS += newValue;	//updates global variable
			stats.childNodes[15].value = ERRORS;
			break;
	}
}

//Gets the textField form the parent div in common with button
function findElement(type){
	var button = document.getElementById("check");
	switch(type){
		case "text":
			return button.parentNode.parentNode.childNodes[1];	//textfield
			break;
		case "help":
			return button.parentNode.parentNode.childNodes[2];	//help button
			break;
	}
}

//Sets the character "char" in the string "string" in position "index"
function setCharAt(string, index, char) {
	if(index > string.length - 1)
		return string;
	return string.substr(0, index) + char + string.substr(index + 1);
}

//Removes all the childs of a node
function removeElements(fatherId){
	var father = document.getElementById(fatherId);
	
	while(father.childNodes.length > 0){
		father.removeChild(main.childNodes[0]);
	}
}

//Decrements the timer and checks if there is a gameover
function timer(){//controllare
	var timer = document.getElementById("timer");
	var left = timer.value;
	if(left > 0){
		timer.value--;
	} else if(LIVES > 0 && !CHECKED){
		writeMessage("Timeout expired! You lost a life");
		updateStats(LEVEL + 2, "errors");
		updateStats(0, "lives");
		clearInterval(TIMER);
		addNextButton();
	} else {
		gameOver(0);
	}
}

//Adds the button to play with the nect animal
function addNextButton(){
	var main = document.getElementById("main");
	if(document.getElementById("next"))
		return;
	var next = document.createElement("input");
	next.setAttribute("type", "button");
	next.setAttribute("id", "next");
	next.setAttribute("value", "Next");
	next.setAttribute("onclick", "restartGame()");
	next.setAttribute("class", "button");
	main.appendChild(next);
}

//Resets the game for the next level
function restartGame(){
	if(LEVEL_TIME > 5)
		LEVEL_TIME = Math.ceil(LEVEL_TIME * 9 / 10) ;
	else 
		LEVEL_TIME = 5;
	CURRENT_HELP = 0;
	CHECKED = false;
	
	removeElements("main");

	getAnimal();
	document.getElementById("timer").value = LEVEL_TIME;
	TIMER = setInterval("timer()", 1000);
}

//Ends the game and inserts stats into chart and your scores
function gameOver(param){
	clearInterval(TIMER);
	removeElements("main");

	var main = document.getElementById("main");
	var title = document.createElement("h2");
	if(param == 0)
		var text = document.createTextNode("Game Over!");
	else
		var text = document.createTextNode("Game Completed!");
	title.appendChild(text);
	main.appendChild(title);
	var percScore = calculatePercentage(SCORE);
	var percHelp = calculatePercentage(5 - HELP);
	var percErr = 100 - percScore - percHelp;
	var p = document.createElement("p");
	p.setAttribute("id", "gameOver");
	text = document.createTextNode("You gave the correct answer for the " + percScore + " % of animals, made " + 
		percErr + "% errors and used the function help tp give " + percHelp + "% of the answers. " + note(percScore));

	p.appendChild(text);
	main.appendChild(p);
	setTimeout("submitForm()", 10000);
}

//Claculates the percentage of correct answers
function calculatePercentage(number){
	return  Math.floor(number * 100 / TOTAL_SCORE);	
}

//Sets the message for the gameover
function note(percScore){
	switch(true){
		case (percScore == 100):
			return "Perfect!";
		case (percScore >= 90):
			return "Amazing!"
		case (percScore >= 80):
			return "Very Good!"
		case (percScore >= 70):
			return "Good!"
		case (percScore >= 60):
			return "Nice!"
		case (percScore < 60):
			return "Play again to learn more!"
	}
}

//Submits the score to "your scores" and to "chart" if it is the best score
function submitForm(){
	document.getElementById("score_form").submit();
}
