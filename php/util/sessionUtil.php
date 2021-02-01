<?php
	
	//sets $_SESSION properly
	function setSession($username, $userId, $email, $gender, $privilege){
		$_SESSION['username'] = $username;
		$_SESSION['userId'] = $userId;
		$_SESSION['email'] = $email;
		$_SESSION['gender'] = $gender;
		$_SESSION['privilege'] = $privilege;
	}

	//checks if user has logged in and eventually returns the user id
	function isLogged(){		
		if(isset($_SESSION['userId']))
			return $_SESSION['userId'];
		else
			return false;
	}

	//checks if user in an administrator
	function isAdmin(){		
		if(isset($_SESSION['privilege'])){
			if($_SESSION['privilege'] == 'Admin')
				return true;
			else
				return false;
		}
	}

?>