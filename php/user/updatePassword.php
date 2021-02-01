<?php 
	session_start();
	require_once "../util/dbManager.php"; //includes Database Class
	require_once "../util/sessionUtil.php"; //includes session util functions

	$id = isLogged();
	if($id === false){
		header("location: ../../index.php");
	}

	if(isset($_POST['newPassword']) && $_POST['newPassword'] != ""){
		$password = $_POST['newPassword'];
		$result = updatePassword($id, $password);
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
	function updatePassword($id, $password){
		global $DB;
		$query = 'UPDATE user SET password = \'' . $password . '\' WHERE userId = \'' . $id . '\'';
		$updated = $DB->performQuery($query);
		if ($updated === FALSE){
			return false;
		} else {
			return true;
		}	
	}


?>