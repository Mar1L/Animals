<?php
    	
	$email = (isset($_POST['email'])) ? $_POST['email'] : "";
	$password = (isset($_POST['password'])) ? $_POST['password'] : "";

	function login($email, $password) {
        if ($email != null && $password != null){
            $foundUser = authenticate($email, $password);	
            $userId;
            $username;
            if ($foundUser != null) {
            	$userId = $foundUser['userId'];
            	$username = $foundUser['name'];
                $gender = $foundUser['gender'];
                $privilege = $foundUser['privilege'];
                
                session_start();
                setSession($username, $userId, $email, $gender, $privilege); // sets session variables
                return null;
            } else {
            	return 'Wrong e-mail or password';
            }
        } else {
            return 'Fields are mandatory';
        }
    }

    function authenticate ($email, $password) {
        global $DB;
        $email = $DB->sqlInjectionFilter($email);
        $password = $DB->sqlInjectionFilter($password);

        $queryText = 'SELECT * FROM User WHERE email = \'' . $email . '\' AND password = \'' . $password . '\'';

        $result = $DB->performQuery($queryText);
        $numRow = mysqli_num_rows($result);
        if ($numRow != 1)
            return null;

        $DB->closeConnection();
        $userRow = $result->fetch_assoc();
        $DB->closeConnection();

        return $userRow;
    } 
?>		

