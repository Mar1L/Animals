<?php 
	session_start();
	require_once "../../php/util/dbManager.php"; //includes Database Class
	require_once "../../php/util/sessionUtil.php"; //includes Session Utils


	if(!isLogged() || !isAdmin()){
		header("location: ../../index.php");
	}
	

	if(isset($_POST['deleteId']) ){
		$todelete = $_POST['deleteId'];
		$result = delete($todelete);
		if($result == true){
			header("location: ./manageUsers.php"); 
		} else {
			$errorMessage = "An error occurred, try again later";
			header("location: ./manageUsers.php?errorMessage= $errorMessage"); 
		}
	} else {
		echo ("unset");
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