<?php
	session_start();
    include "../../php/util/sessionUtil.php"; //includes Session Utils

    if(!isLogged() || !isAdmin()){
		header('location: ../../index.php');
	}
?>	

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Marilisa Lippini">
    	<meta name = "keywords" content = "game, register">
		<link rel="stylesheet" href="../css/register.css" type="text/css" media="screen">
		<script src="../../js/formHandler.js"></script>
		<title>Register!</title>
	</head>
	<body>
		<header>
			<h1>Register new Admin</h1>
			<aside id="navigation" class="top">
	            <nav>
	            	<a href="../../php/logout.php">Logout</a>
	            	<a href="./insertImage.php">Edit Game</a>
	            	<a href="./registerAdmin.php">New Admin Account</a>
	            	<a href="./manageUsers.php">Manage Users</a>
	            </nav>
	        </aside>
		</header>
		
		<form name="register" action="./validateRegistrationAdmin.php" method="post">	
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
					<label for="boy">Male</label>
					<input type="radio" id="boy" name="gender" value="Boy">
					<label for="girl">Female</label>
					<input type="radio" id="girl" name="gender" value="Girl">
					<label for="others">Others</label>
					<input type="radio" id="others" name="gender" value="Others">
				</div>
				<div>
					<label for="email">E-mail: *</label><br>
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
	</body>
</html>

