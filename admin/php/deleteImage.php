<?php 
	session_start();
	require_once "../../php/util/dbManager.php"; //includes Database Class
	require_once "../../php/util/sessionUtil.php"; //includes Session Utils


	if(!isLogged() || !isAdmin()){
		header("location: ../../index.php");
	}
	

	if(isset($_POST['name']) ){
		$todelete = $_POST['name'];
		$result = delete($todelete);
		if($result == true){
			header("location: ./insertImage.php"); 
			$errorMessage = "Image deleted successfully";
			header("location: ./insertImage.php?errorMessage= $errorMessage");
		} else {
			$errorMessage = "An error occurred, try again later";
			header("location: ./insertImage.php?errorMessage= $errorMessage"); 
		}
	} else {
		echo ("unset");
	}

	//Deletes an image from the database
	function delete($caption){
		global $DB;
		$query = 'DELETE FROM picture WHERE caption = \'' . $caption . '\'';
		$deleted = $DB->performQuery($query);
		if ($deleted === FALSE){
			return false;
		}
		return true;
	}