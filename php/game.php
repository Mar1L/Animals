<?php
	session_start();
	require_once "./util/sessionUtil.php"; //includes Session Utils

	if(!isLogged() || isAdmin()){
		header('location: ../index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
		<meta name="author" content="Marilisa Lippini">
		<meta name="keywords" content="game, animals">
		<link rel="stylesheet" href="../css/game.css" type="text/css" media="screen">
		<script src="../js/game.js"></script>
		<title>Animals</title>
	</head>
	<body onLoad="howToPlay()"> 
		<header>
			<h1><a href="./game.php" title="Home"><img src="../img/tiger.png" alt="Tiger"></a>Animals</h1>
			
			<aside class="top">
			<nav id="navigation">
				<a href="./logout.php">Logout</a>
				<a href="./user/userProfile.php">Profile</a>
				<a href="./game.php">Play</a>
				<a href="./user/userScores.php">Your Scores</a>
				<a href="./chart.php">Chart</a>
				<a href="../html/guide.html" target="_blank">Help</a> 
			</nav>

				<p id ="profile" >
					<?php
						if(isset($_SESSION['username'])){
							echo('Welcome '. $_SESSION['username'] .'!');
						} else {
							echo('Welcome unknow user!');
						}
					?>	
				</p>
			</aside>
		</header>
		
		<div id="game_wrapper">
			<!--Game built by function "begin" in file game.js-->

			<form id="score_form" action = "./submitScore.php" method="post" style="visibility: hidden;">
				<p id="score_span">
					<label for="lives">Lives :</label>
					<input class="number" type="number" id="lives" name="lives" readonly="readonly" value="2">
					<label for="helps">Helps :</label>
					<input class="number" type="number" id="helps" name="helps" readonly="readonly" value="4">
					<label for="score">Score:</label>
					<input class="number" type="number" id="score" name="score" readonly="readonly" value="0">
					<label for="errors">Errors:</label>
					<input class="number" type="number" id="errors" name="errors" readonly="readonly" value="0">
				</p>
				<a id="submit" class="button" href="javascript: submitForm()" style="visibility: hidden;"></a>
			</form>
			<div id="topGame">
				<div id="leveldiv" style="visibility: hidden;">
					<p id="levelp">Level:</p>
					<p id = "level">1</p>
				</div>
				<div id="time" style="visibility: hidden;">
					<label for="timer">Time Left:</label>
					<input id = "timer" type="number" name="timer" readonly="readonly" value="30">
				</div>
			</div>
       	</div>

		<main id="main">
			<!--filled by game.js-->   
			
       		
		</main>
	</body>
</html>