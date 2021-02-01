<?php
	session_start();
    require_once "../util/sessionUtil.php";
    require_once "./user.php";

    $id = isLogged();
    $user;
   	if($id == false){
    	header('location: ../../index.php');
    } else {
    	$user = getUser($id);
    }
    $username = $user['name'];
    $age = $user['age'];
    $gender = $user['gender'];
    $email = $user['email'];
    $password = $user['password'];
    $profilePic = $user['profilePic'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
    	<meta name="author" content="Marilisa Lippini">
    	<meta name="keywords" content="game, profile">
		<link rel="stylesheet" href="../../css/profile.css" type="text/css" media="screen">
		<script src="../../js/formHandler.js"></script>      
		<title>Personal Profile</title>
	</head>
	<body>
		<header>
			<h1><a href="./userProfile.php" title="Home"><img src="../../img/leo.png" alt="Lion"></a>Your Profile</h1>
			<nav id="navigation" class="top">
				<a href="../logout.php">Logout</a>
				<a href="./userProfile.php">Profile</a>
				<a href="../game.php">Play</a>
				<a href="./userScores.php">Your Scores</a>
				<a href="../chart.php">Chart</a>
				<a href="../../html/guide.html" target="_blank">Help</a> 
			</nav>
		</header>
			
		<div id="data">	
			<span id="pic" onclick="setVisibility('image', 'imageButton', 'visible')">
				<?php 
					$pathImage = "../../img/profilePics/" . $user['profilePic'];
					if($profilePic === '0')
						echo "<img src='../../img/profilePics/default.png' alt='Your Pic' id='picture' class='$gender'>";
					else
						echo "<img src='$pathImage' alt='Your Pic' id='picture' class='$gender'>";
				?>
			</span>

			<div id="bestScore">
				<h3>Your Best Score</h3>
				<?php 
					getBestScore($id);
				?>
			</div>
				

			<form action="uploadImage.php" method="POST" enctype="multipart/form-data" style="visibility: hidden">
				<input type="file" name="image" id="image">
				<input id="imageButton" class="button" type="submit" value="Upload Image" name="submit">
			</form>
		
			<div>
				<label for="name">Name: </label>
				<span id="username"><?php echo $username?></span>
				<input id="changeName" class="button" type="button" value="Change Name" onclick="setVisibility('name', 'nameButton', 'visible')">
				<form name="data" method="POST" action="./updateName.php">
					<input type="text" name="newName" id="name" placeholder="New Name" style="visibility: hidden" oninput="checkName('nameButton')">
					<input class="updateButton" id="nameButton" type="submit" value="Update"  style="visibility: hidden">
					<p id="name_error"></p><!--filled by formHandler.js-->
				</form>
			</div>
			
			<div>
				Gender: 
				<span id="user_gender"><?php echo $gender?></span>
				<input id="changeGender" class="button" type="button" value="Change Gender" onclick="setVisibility('gender', 'genderButton', 'visible')">
				<form name="data" method="POST" action="./updateGender.php">
					<div id="gender" style="visibility: hidden">
						<label for="boy">Boy</label>
						<input type="radio" id="boy" name="gender" value="Boy">
						<label for="girl">Girl</label>
						<input type="radio" id="girl" name="gender" value="Girl">
						<label for="others">Others</label>
						<input type="radio" id="others" name="gender" value="Others">
					</div>
					<input class="updateButton" id="genderButton" type="submit" value="Update"  style="visibility: hidden">
				</form>
			</div>	
			<div>
				<label for="age">Age: </label>
				<span id="user_age"><?php echo $age?></span>
				<input id="changeAge" class="button" type="button" value="Change Age" onclick="setVisibility('age', 'ageButton', 'visible')">
				<form name="data" method="POST" action="./updateAge.php">
					<input type="number" name="newAge" id="age" placeholder="New Age" style="visibility: hidden" oninput="checkAge('ageButton')">
					<input class="updateButton" id="ageButton" type="submit" value="Update"  style="visibility: hidden">
					<p id="age_error"></p><!--filled by formHandler.js-->
				</form>
			</div>

			<div>
				<label for="email">Email: </label>
				<span id="e-mail"><?php echo $email?></span><br>
				<input id="changeEmail" class="button" type="button" value="Change Email" onclick="setVisibility('email', 'emailButton', 'visible')">
				<form name="data" method="POST" action="./updateEmail.php">
					<input type="text" name="newEmail" id="email" placeholder="New E-mail" style="visibility: hidden" oninput="checkMail('emailButton')">
					<input class="updateButton" id="emailButton" type="submit" value="Update"  style="visibility: hidden">
					<p id="email_error"></p><!--filled by formHandler.js-->
				</form>
			</div>

			<div>
				<label for="password" id="password_label">Password: </label>
				<span id="password_span"><?php echo '*******'?></span>
				<input id="changePassword" class="button" type="button" value="Change Password" onclick="setVisibility('password', 'passwordButton', 'visible')">
				<form name="data" method="POST" action="./updatePassword.php">		
					<input type="password" name="newPassword" id="password" placeholder="New Password" style="visibility: hidden" oninput="checkSecurity('passwordButton')">
					<input class="updateButton" id="passwordButton" type="submit" value="Update"  style="visibility: hidden">
					<p id="password_error"></p><!--filled by formHandler.js-->
				</form>
			</div>
			<div>
				<form method="POST" action="./deleteUser.php">		
					<input class="button" name="delete" type="submit" value="Delete Account" id="delete">
				</form>
			</div>
		</div>
		<div id="error">
			<?php
				if (isset($_GET['errorMessage'])){
					echo '<p class="error">';
					echo '<span>' . $_GET['errorMessage'] . '</span>';
					echo '</p>';
				}
			?>
		</div>
	</body>
</html>