<?php
	session_start();
	require_once "./util/dbManager.php"; //includes Database Class
    require_once "./util/sessionUtil.php"; //includes session util functions
   
	global $DB;
	
	$errorMessage; 
	$username;

	$userId = isLogged();
	if($userId){
		$username = $_SESSION['username'];
	} else {
		header("location: ./login.php");
	}
	

	if(isset($_POST['score']) && isset($_POST['errors']) && isset($_POST['lives']) && isset($_POST['helps'])){
		$score = $_POST['score'];
		$errors = $_POST['errors'];
		$lives = $_POST['lives'];
		$helps = $_POST['helps'];

		$time = date("Y-m-d h:i:s");
		echo($score);echo($errors);echo($lives);echo($helps);
		addScore($userId, $username, $score, $errors, $lives, $helps, $time);
		
	} else {
		
		$errorMessage = "An error occurred, try again!"; echo($errorMessage);
	}

    //Inserts the new score into the database
    function addScore($userId, $username, $score, $errors, $lives, $helps, $time){
    	global $DB;
		$newScore = 'INSERT INTO game ' .
		' VALUES(\'\', \'' . $userId . '\', \'' . $score . '\', \'' . $errors . '\', \'' . $lives . '\', \'' . $helps . '\', \'' . $time . '\')';
		$result = $DB->performQuery($newScore);
		$DB->closeConnection();

		if($result === TRUE){
			//if it's the best score update the chart 
			updateChart($userId, $score, $errors, $lives, $helps, $time);
			header('location: ./chart.php');
		} else {
			$errorMessage = "Generic error<br>";
			header("location: ./game.php?errorMessage= $errorMessage");
		}
		
	}

		

	function updateChart($userId, $score, $errors, $lives, $helps, $gameTime){
		global $DB;

		$id = $DB->sqlInjectionFilter($userId);
		$query = 'SELECT * FROM chart WHERE user_userId = \'' . $id . '\'';
		$result = $DB->performQuery($query);
		$numRow = mysqli_num_rows($result);

		//User already in chart
		if($numRow > 0){echo"user in chart";
			//searches the game that is currently in chart
			$query = 'SELECT * FROM chart JOIN game ON game_gameId = gameId WHERE chart.user_userId =\'' . $id . '\'';
			$result = $DB->performQuery($query);
			$chartRow = $result->fetch_assoc();

			//New best score
			$condition = false;
			if($score >= $chartRow['score'])
				$condition = true;
			else if($score == $chartRow['score'] && $errors <= $chartRow['errors'])
				$condition = true;
			else if($score == $chartRow['score'] && $errors == $chartRow['errors'] && $errors <= $chartRow['errors'])
				$condition = true;
			else if($score == $chartRow['score'] && $errors == $chartRow['errors'] && $errors <= $chartRow['errors'] && $lives >= $chartRow['lives'])
				$condition = true;
			else if($score == $chartRow['score'] && $errors == $chartRow['errors'] && $errors <= $chartRow['errors'] && $lives == $chartRow['lives'] && $helps >= $chartRow['helps'])
				$condition = true;
			
			if($condition){

				//Finds the last game 				
				$query = 'SELECT gameId FROM game WHERE user_userId = \'' . $id . '\' AND
				 gameTime = \'' . $gameTime . '\'';
				$result = $DB->performQuery($query);
				$gameRow = $result->fetch_assoc();
				$game = $gameRow['gameId'];

				//update
				$query = 'UPDATE chart SET game_gameId = \'' . $game . '\' WHERE user_userId = \'' . $id . '\'';
				$updated = $DB->performQuery($query);
				if ($updated === FALSE){
					$errorMessage = "Score could not be updated";
		    	} else {
		    		$errorMessage = "score updated<br>";
		    	}
		    }

		} else {echo"user not in chart";
			$query = 'SELECT gameId FROM game WHERE user_userId = \'' . $id . '\'';
			$result = $DB->performQuery($query);
			$res = $result->fetch_assoc();
			$game = $res['gameId'];

			$query = 'INSERT INTO chart ' . ' VALUES(\'\', \'' . $id . '\', \'' . $game . '\')';
			$inserted = $DB->performQuery($query);
			if ($inserted === FALSE){
				$errorMessage = "User could not be added to chart<br>";
	    	}
		}
		
    	$DB->closeConnection();
	}
?>
