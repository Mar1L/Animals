<?php 
	session_start();
	require_once "../util/dbManager.php"; //includes Database Class
	require_once "../util/sessionUtil.php"; //includes session util functions

	$id = isLogged();
	if($id === false){
		header("location: ../../index.php");
	}

	if(isset($_POST['delete']) ){
		$result = delete($id);
		if($result == true){
			session_destroy();
			header("location: ../../index.php"); 
		} else {
			$errorMessage = "An error occurred, try again later";
			header("location: ./userProfile.php?errorMessage= $errorMessage"); 
		}
	}

	//Deletes a user and the relative position in chart and scores 
	//(should be done automatically -> on update cascade)
	function delete($id){
		global $DB;
		
		//delete games
		$query = 'DELETE FROM game WHERE user_userId = \'' . $id . '\'';
		$deleted = $DB->performQuery($query);
		if ($deleted === FALSE){
			return false;
		} 

		//delete from chart
		$query = 'DELETE FROM chart WHERE user_userId = \'' . $id . '\'';
		$deleted = $DB->performQuery($query);
		if ($deleted === FALSE){
			return false;
		}

		//delete user
		$query = 'DELETE FROM user WHERE userId = \'' . $id . '\'';
		$deleted = $DB->performQuery($query);
		if ($deleted === FALSE){
			return false;
		} else {
			return true;
		}
	}
?>