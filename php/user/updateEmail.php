<?php 
	session_start();
	require_once "../util/dbManager.php"; //includes Database Class
	require_once "../util/sessionUtil.php"; //includes session util functions
	require_once "./user.php";	//includes functions for the user

	$id = isLogged();
	if($id === false){
		header("location: ../../index.php");
	}

	if(isset($_POST['newEmail']) && $_POST['newEmail'] != ""){
		$email = $_POST['newEmail'];
		$result = updateEmail($id, $email);
		if($result == true){
			header("location: ./userProfile.php"); 
		} else {
			$errorMessage = "An error occurred, try again later ";
			header("location: ./userProfile.php?errorMessage= $errorMessage"); 
		}
	} else {
		$errorMessage = "The field must contain a value";
		header("location: ./userProfile.php?errorMessage= $errorMessage"); 
	}

	//Updates the email for the user
	function updateEmail($id, $email){
		global $DB;
		//checks if the email is already registered, file user.php
		if(emailUsed($email) === true){
        	$errorMessage = "E-mail already used";
        	header("location: ./userProfile.php?errorMessage= $errorMessage");
    	} else {
    		//Updates the email
			$query = 'UPDATE user SET email = \'' . $email . '\' WHERE userId = \'' . $id . '\'';
			$updated = $DB->performQuery($query);
			if ($updated === FALSE){
				return false;
			} else {
				return true;
			}
		} 
	}
?>