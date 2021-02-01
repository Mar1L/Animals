<?php 
	session_start();
	require_once "../../php/util/dbManager.php"; //includes Database Class
	require_once "../../php/util/sessionUtil.php"; //includes Session Utils

	if(!isLogged() || !isAdmin()){
		header('location: ../../index.php');
	}

	function selectAll(){
		global $DB;
		$query = 'SELECT * FROM user ORDER BY privilege ASC';
		$result = $DB->performQuery($query);
		$rows = mysqli_num_rows($result);

		if ($rows > 0) {
		    //Printing data of every user
		    echo "<table>" . "<tr>" . "<th>ID</th>" . "<th>Name</th>" . "<th>Age</th>" . "<th>Gender</th>" . "<th>E-mail</th>" . "<th>Role</th>" . "</tr>";
     
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr><td>" . $row["userId"] . "</td><td>" . $row["name"] . "</td><td>" . $row["age"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["email"] . "</td><td>" . $row["privilege"] . "</td></tr>" ;
		    }
		    echo "</table>";
		} else {
		    echo "There are no users";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
    	<meta name="author" content="Marilisa Lippini">
    	<meta name="keywords" content="game, animals">
		<link rel="stylesheet" href="../css/manageUsers.css" type="text/css" media="screen">
                
		<title>manage Users</title>
	</head>
	<body> 
		<header>
			<h1>Manage Users</h1>
			<aside id="navigation" class="top">
	            <nav>
	            	<a href="../../php/logout.php">Logout</a>
	            	<a href="./insertImage.php">Edit Game</a>
	            	<a href="./registerAdmin.php">New Admin Account</a>
	            	<a href="./manageUsers.php">Manage Users</a>
	            	
	            </nav>
	        </aside>
		</header>
		<div>
			<?php
				selectAll();
			?>
		</div>

		<form id="delete" name="data" method="POST" action="./deleteUser.php">
			<label for="name">Insert here the ID of the user to delete</label><br>
			<input type="text" name="deleteId" id="name" placeholder="ID">
			<input class="button" type="submit" value="Delete">
		</form>


	</body>
</html>