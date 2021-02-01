<?php 
	session_start();
	require_once "../util/dbManager.php"; //includes Database Class
	require_once "../util/sessionUtil.php"; //includes session util functions

	$id = isLogged();
	if($id === false){
		header("location: ../../index.php");
	}

	if(isset($_POST['newName']) && $_POST['newName'] != ""){
		$name = $_POST['newName'];
		$result = updateName($id, $name);
		if($result == true){
			header("location: ./userProfile.php"); 
		} else {
			$errorMessage = "An error occurred, try again later";
			header("location: ./userProfile.php?errorMessage= $errorMessage"); 
		}
	} else {
		$errorMessage = "The field must contain a value";
		header("location: ./userProfile.php?errorMessage= $errorMessage"); 
	}

	//Updates the password for the user
	function updateName($id, $name){
		global $DB;
		$query = 'UPDATE user SET name = \'' . $name . '\' WHERE userId = \'' . $id . '\'';
		$updated = $DB->performQuery($query);
		if ($updated === FALSE){
			return false;
		} else {
			return true;
		}	
	}


?>