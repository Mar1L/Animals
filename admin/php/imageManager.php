<?php
	session_start();
	require_once "../../php/util/dbManager.php"; //includes Database Class
	require_once "../../php/util/sessionUtil.php"; //includes Session Utils

	if(!isAdmin()){
		header('location: ../../index.php');
	}

	global $DB;
	$errorMessage="";

	if(isset($_POST['caption'])){
		$caption = $_POST['caption'];
		$url = $_POST['url'];
		$errorMessage = insert($caption, $url);
		header("location: ./insertImage.php?errorMessage= $errorMessage");
	} else {

	}
	

	function insert($caption, $url){
		global $DB;
		$existing = retrieve($caption);
		if($existing){
			return "The picture is already in the database";
		}
		$query = 'INSERT INTO picture ' . ' VALUES(\'\', \'' . $caption . '\', \'' . $url . '\')';
		$result = $DB->performQuery($query);
		if($result === TRUE){
			return "New picture added succesfully";
		} else {
			return "Generic error";
		}

	}

	function retrieve($caption){
		global $DB;
		$query = 'SELECT * FROM picture WHERE caption = \'' . $caption . '\'';
		$result = $DB->performQuery($query);
	    $rows = mysqli_num_rows($result);
	    if ($rows > 0){
			$assoc = $result->fetch_assoc();
			return $assoc;
	    } else {
	    	$errorMessage = "error";
	    }
	}

?>