<?php
	session_start();
	require_once "../util/dbManager.php"; //includes Database Class
	require_once "../util/sessionUtil.php"; //includes session util functions
	require_once "../user/user.php"; //includes functions for the user

	if(!isLogged() || isAdmin()){
		header('location: ../../index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
    	<meta name="author" content="Marilisa Lippini">
    	<meta name="keywords" content="game, animals, chart">
		<link rel="stylesheet" href="../../css/score.css" type="text/css" media="screen">
        <title>Chart</title>
	</head>
	<body>
		<header>
			<nav id="navigation" class="top">
				<a href="../logout.php">Logout</a>
				<a href="./userProfile.php">Profile</a>
				<a href="../game.php">Play</a>
				<a href="./userScores.php">Your Scores</a>
				<a href="../chart.php">Chart</a>
				<a href="../../html/guide.html" target="_blank">Help</a> 
			</nav>
		</header>
		<h1><a href="./userScores.php" title="Home"><img class="logo" src="../../img/leo.png" alt="Lion"></a>Your Scores</h1>
		<div>
			<?php
				loadScores();
			?>
		</div>


	</body>
</html> 