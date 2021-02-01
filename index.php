<?php
	require_once "./php/util/dbManager.php"; //includes Database Manager
	require_once "./php/util/sessionUtil.php"; //includes Session Utils
	require_once "./php/login.php"; //includes functions for the login
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
		<meta name="author" content="Marilisa Lippini">
		<meta name="keywords" content="game, animals">
		<link rel="stylesheet" href="./css/index.css" type="text/css" media="screen">
		<script src="./js/game.js"></script>
		<title>Animals</title>
	</head>
	<body> 
		<header>
			<h1><a href="./index.php" title="Home"><img src="./img/leo.png" alt="Lion"></a>Animals</h1>
		</header>

		<main>
			<fieldset id="login_form">
				<legend>Log in now!</legend>
				<form name="login" action="./index.php" method="post">
					<label for="email">E-mail:</label><br>
					<input type="text" id = "email" name="email" placeholder="emal@gmail.com" autofocus><br><!--required-->
					<label>Password:</label><br>
					<input type="password" id="password" name="password" placeholder="Password"><br>
					<input name="login" type="submit" value="Login" class="button"><br>

					<?php
						global $DB;
						$errorMessage = login($email, $password);
						$error;
						//Checks the fields e-mail and password when the user click on the button "Login"
				        if(isset($_POST['login'])) {
				        	if($errorMessage !== null){
				            	echo '<div class="error"><span>';
								echo($errorMessage);
								echo '</span></div>';
				            } else if(isAdmin()) {	//home admin
								header('location: ./admin/php/manageUsers.php');
							} else {	//home user
								header('location: ./php/game.php');
							}
						}
					?>

				</form>
			</fieldset>
			<fieldset id="register_form">
				<legend>Don't have an account?</legend>
				<a href="./php/register.php" class="button">Register now!</a>
			</fieldset>
		</main>
		
		<footer>
			<a href="./html/privacy.html" target="_blank">Privacy Policy</a>
			<a href="./html/terms_of_service.html" target="_blank">Terms of Service</a>	
		</footer>
	</body>
</html>
