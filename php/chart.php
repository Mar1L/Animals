<?php
	session_start();
	require_once "./util/dbManager.php"; //includes Database Class
	require_once "./util/sessionUtil.php";

	if(!isLogged() || isAdmin()){
		header('location: ../index.php');
	}

	function loadChart(){
		global $DB;
		
		$query = 'SELECT * FROM chart JOIN user ON user_userId = userId JOIN game ON game_gameId = gameId
		GROUP BY userId ORDER BY score DESC, errors ASC, lives DESC, helps DESC, age ASC';
        $result = $DB->performQuery($query);
		$rows = mysqli_num_rows($result);
		
		if ($rows > 0) {

		    //Printing the score for every player
		    echo "<table>" . "<tr>" . "<th>Pic</th>" . "<th>Player</th>" . "<th>Age</th>" . "<th>Score</th>" . "<th>Errors</th>" . "<th>Lives</th>" . "<th>Helps</th>" . "</tr>";
     
		    while($row = $result->fetch_assoc()) {

				$pathImage = "../img/profilePics/" . $row['profilePic'];
				$source;
				$gender = $row['gender'];
				if($row['profilePic'] === '0')
					$source = '../img/profilePics/default.png';
				else
					$source = $pathImage;

		    	echo "<tr>" . "<td>" . "<img src='$source' alt='Your Pic' class='$gender'>" . "</td><td>"
		    	 . $row["name"] . "</td><td>" . $row["age"] . "</td><td>" . $row["score"] . "</td><td>" 
		    	 . $row["errors"] . "</td><td>" . $row["lives"] . "</td><td>" . $row["helps"] . "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "Empty chart";
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
    	<meta name="author" content="Marilisa Lippini">
    	<meta name="keywords" content="game, animals, chart">
		<link rel="stylesheet" href="../css/chart.css" type="text/css" media="screen">
        <title>Chart</title>
	</head>
	<body>
		<header>
			<nav id="navigation" class="top">
				<a href="./logout.php">Logout</a>
				<a href="./user/userProfile.php">Profile</a>
				<a href="./game.php">Play</a>
				<a href="./user/userScores.php">Your Scores</a>
				<a href="./chart.php">Chart</a>
				<a href="../html/guide.html" target="_blank">Help</a> 
			</nav>
		</header>
		<h1><a href="./chart.php" title="Home"><img class="logo" src="../img/leo.png" alt="Lion"></a>Chart</h1>
		<div>
			<?php
				loadChart();
			?>
		</div>


	</body>
</html> 