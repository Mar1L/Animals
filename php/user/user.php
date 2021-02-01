<?php
	require_once "../util/dbManager.php";
	require_once "../util/sessionUtil.php";

	//Returns false if the user is not in the database, his id otherwise
	function getUser($id) {
		global $DB;
		$query = 'SELECT * FROM user WHERE userId = \'' . $id . '\'';
		$result = $DB->performQuery($query);
		$numRows = mysqli_num_rows($result);
		if($numRows == 0) {
			return false;
		}
		$user = $result->fetch_assoc();
		$DB->closeConnection();

		return $user;
	}

	//Returns true if the email is already in the database
	function emailUsed($email) {
		global $DB;
		$email = $DB->sqlInjectionFilter($email);
		$query = 'SELECT * FROM user WHERE email = \'' . $email . '\'';
		$result = $DB->performQuery($query);
		$numRows = mysqli_num_rows($result);

		//Email already used
		if($numRows > 0){
			return true;
		}
		$DB->closeConnection();
		return false;
	}

	//Finds the best score for the given user
	function getBestScore($id){
		global $DB;
		$query = 'SELECT * FROM game WHERE score = (SELECT MAX(Score) FROM game WHERE user_userId = \'' . $id . '\')';
		$result = $DB->performQuery($query);
		$rows = mysqli_num_rows($result);

		if ($rows > 0) {
		    //Printing the score for every game
		    echo "<table>" . "<tr>" . "<th>Score</th>" . "<th>Errors</th>" . "<th>Lives</th>" . "<th>Helps</th>" . "<th>Time</th>" . "</tr>";
     
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr>" . "<td>" . $row["score"] . "</td><td>" . $row["errors"] . "</td><td>" . $row["lives"] . "</td><td>" . $row["helps"] . "</td><td>" . $row["gameTime"] . "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "You have never played yet!";
		}
		$DB->closeConnection();
	}

	//Shows to a user all his previous scores
	function loadScores(){
		$id = isLogged();
		if($id == false){
    		header('location: ../../index.php');
    	}
		global $DB;

        $query = 'SELECT * FROM game WHERE user_userId = \'' . $id . '\' ORDER BY gameTime DESC';
        $result = $DB->performQuery($query);
		$rows = mysqli_num_rows($result);
		
		if ($rows > 0) {
		    //Printing the score for every game
		    echo "<table>" . "<tr>" . "<th>Score</th>" . "<th>Errors</th>" . "<th>Lives</th>" . "<th>Helps</th>" . "<th>Time</th>" . "</tr>";
     
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr><td>" . $row["score"] . "</td><td>" . $row["errors"] . "</td><td>" . $row["lives"] . "</td><td>" . $row["helps"] ."</td><td>" . $row["gameTime"] . "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "You have never played yet!";
		}
	}

	
?>