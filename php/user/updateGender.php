<?php 
	session_start();
	require_once "../util/dbManager.php"; //includes Database Class
	require_once "../util/sessionUtil.php"; //includes session util functions

	$id = isLogged();
	if($id === false){
		header("location: ../../index.php");
	}

	if(isset($_POST['gender']) && $_POST['gender'] != ""){
		$gender = $_POST['gender'];
		$result = updateGender($id, $gender);
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
	function updateGender($id, $gender){
		global $DB;
		$query = 'UPDATE user SET gender = \'' . $gender . '\' WHERE userId = \'' . $id . '\'';
		$updated = $DB->performQuery($query);
		if ($updated === FALSE){
			return false;
		} else {
			return true;
		}	
	}


?>