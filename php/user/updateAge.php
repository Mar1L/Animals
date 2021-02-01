<?php 
	session_start();
	require_once "../util/dbManager.php"; //includes Database Class
	require_once "../util/sessionUtil.php"; //includes session util functions

	$id = isLogged();
	if($id === false){
		header("location: ../../index.php");
	}

	if(isset($_POST['newAge']) && $_POST['newAge'] != ""){
		$age = $_POST['newAge'];
		$result = updateAge($id, $age);
		if($result == true){
			header("location: ./userProfile.php"); 
		} else {
			$errorMessage = "An error occurred, try again later" + result;
			header("location: ./userProfile.php?errorMessage= $errorMessage"); 
		}
	} else {
		$errorMessage = "The field must contain a value";
		header("location: ./userProfile.php?errorMessage= $errorMessage"); 
	}

	//Updates the password for the user
	function updateAge($id, $age){
		global $DB;
		$query = 'UPDATE user SET age = \'' . $age . '\' WHERE userId = \'' . $id . '\'';
		$updated = $DB->performQuery($query);
		if ($updated === FALSE){
			return ;
		} else {
			return true;
		}	
	}
?>