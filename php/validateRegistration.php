<?php
	require_once "./util/dbManager.php"; //includes Database Class
    require_once "./util/sessionUtil.php"; //includes session util functions
       
	global $DB;

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    //Checks if the form has been filled
    if($name == null || $age == null || $gender == null || $email == null || $password == null || 
        $repeat_password !== $password){
        $errorMessage = "Please fill all the fields";
        header("location: ./register.php?errorMessage= $errorMessage");
    }

    $errorMessage;
    
    //checks if the email is already registered
    $query = 'SELECT * FROM user WHERE email = \'' . $email . '\'';
    $foundEmail = $DB->performQuery($query);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        $errorMessage = "E-mail already used";
        header("location: ./register.php?errorMessage= $errorMessage");
    } else {
        //Inserts the new user into the database
    	$newUser = 'INSERT INTO user ' .
    	' VALUES(\'\', \'' . $name . '\', \'' . $age . '\', \'' . $gender . '\' , \'' . $email . '\', \'' . $password . '\',  \'User\', \'0\')';
    	$result = $DB->performQuery($newUser);
    	if($result == TRUE){
    		header('location: ../index.php');
    	} else {
            $errorMessage = "There was an error, try again later";
    		header("location: ./register.php?errorMessage= $errorMessage");
    	}
    	$DB->closeConnection();
    }
?>