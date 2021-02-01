<?php
	require_once "../../php/util/dbManager.php"; //includes Database Class
    require_once "../../php/util/sessionUtil.php"; //includes session util functions
   
	global $DB;

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Checks if the form has been filled
    if($name == null || $age == null || $gender == null || $email == null || $password == null || 
        $repeat_password !== $password){
        $errorMessage = "Please fill all the fields";
        header("location: ./registerAdmin.php?errorMessage= $errorMessage");
    }

    $errorMessage;
    
    //checks if the email is already registered
    $query = 'SELECT * FROM user WHERE email = \'' . $email . '\'';
    $foundEmail = $DB->performQuery($query);

    $rows = mysqli_num_rows($foundEmail);
    if ($rows > 0){
		$errorMessage = "E-mail already used";
    }

    //Inserts the new user into the database
	$newUser = 'INSERT INTO user ' .
	' VALUES(\'\', \'' . $name . '\', \'' . $age . '\', \'' . $gender . '\' , \'' . $email . '\', \'' . $password . '\',  \'Admin\', \'0\')';
	$result = $DB->performQuery($newUser);
	if($result === TRUE){
		header("location: ./manageUsers.php");
	} else {
		header("location: ./registerAdmin.php?errorMessage= $errorMessage");
	}
	$DB->closeConnection();

?>