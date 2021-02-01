<?php
	session_start();
    include "./util/sessionUtil.php"; //includes Session Utils
?>	

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Marilisa Lippini">
    	<meta name = "keywords" content = "game, register">
		<link rel="stylesheet" href="../css/register.css" type="text/css" media="screen">
		<script src="../js/formHandler.js"></script>
		<title>Register!</title>
	</head>
	<body>
		<h1>Register now!</h1>
		<form name="register" action="./validateRegistration.php" method="post">	
			<fieldset id="register_form">
				<div>
					<label for="name">Name: *</label><br>
					<input id="name" name="name" type="text" placeholder="Name" oninput="checkName('submit_registration')" autofocus><!--required-->
					<p id="name_error" class="error_message"></p><!--filled by formHandler.js-->
				</div>
				<div>
					<label for="age">Age:</label><br>
					<input type="number" id="age" name="age"  oninput="checkAge('submit_registration')"placeholder="Age" oninput="checkAge('submit_registration')">
					<p id="age_error"></p><!--filled by formHandler.js-->
				</div>
				<div>
					<label for="boy">Boy</label>
					<input type="radio" id="boy" name="gender" value="Boy">
					<label for="girl">Girl</label>
					<input type="radio" id="girl" name="gender" value="Girl">
					<label for="others">Others</label>
					<input type="radio" id="others" name="gender" value="Others">
				</div>
				<div>
					<label for="email">Parent's E-mail: *</label><br>
					<input id="email" name="email" type="text" placeholder="emal@gmail.com" oninput="checkMail('submit_registration')"> 
					<p id="email_error"></p><!--filled by formHandler.js-->
				</div>
				<div>
					<label for="password">Password: *</label><br>
					<input id="password" name="password" type="password" placeholder="Password" onkeyup="('password')" oninput="checkSecurity('submit_registration')">
					<p id="password_error"></p><!--filled by formHandler.js-->
				</div>
				<div>
					<label for="repeat_password">Repeat password: *</label><br>
					<input id="repeat_password" name="repeat_password" type="password" placeholder="Repeat your password" onkeyup="('repeat_password')" oninput="passwordsMatch('submit_registration')">
					<p id="repassword_error"></p><!--filled by formHandler.js-->
				</div>
				<input id ="reset"  name="reset" type="reset" class="button"  value="Reset" onclick="clearStyle()">
				<input id ="submit_registration" name="register" type="submit" class="button" value="Register">
			</fieldset>
				<?php
					if (isset($_GET['errorMessage'])){
						echo '<p class="error">';
						echo '<span>' . $_GET['errorMessage'] . '</span>';
						echo '</p>';
					}
				?>
		</form>
		<footer>
			<p id="login">Already registered? <a href="../index.php">Log in!</a></p>
			<div>
				<a href="../html/terms_of_service.html" target="_blank">Terms of Service</a>
				<a href="../html/privacy.html" target="_blank">Privacy</a>
			</div>
		</footer>
	</body>
</html>

