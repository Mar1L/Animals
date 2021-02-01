<?php
	session_start();
	require_once "../../php/util/dbManager.php"; //includes Database Class
	require_once "../../php/util/sessionUtil.php"; //includes Session Utils

	if(!isLogged() || !isAdmin()){
		header('location: ../../index.php');
	}

	function getList(){
		global $DB;
		$query = 'SELECT * FROM picture ORDER BY caption';
		$result = $DB->performQuery($query);
		$rows = mysqli_num_rows($result);

		if ($rows > 0) {
		    //Printing data of every picture
		    echo "<table>" . "<tr>" . "<th>Caption</th>" . "<th>Image</th>" . "</tr>";
     
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr><td>" . $row["caption"] . "</td><td>" . 
		    	"<image src='" . $row["url"] . "' alt='" . $row["caption"] . "'>" . "</td></tr>" ;
		    }
		    echo "</table>";
		} else {
		    echo "There are no images";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Marilisa Lippini">
    	<meta name = "keywords" content = "game, images">
		<link rel="stylesheet" href="../css/manageImages.css" type="text/css" media="screen">
		<title>Add Images</title>
	</head>
	<body>
		<header>
			<h1>Edit the Game</h1>
			<aside id="navigation" class="top">
	            <nav>
	            	<a href="../../php/logout.php">Logout</a>
	            	<a href="./insertImage.php">Edit Game</a>
	            	<a href="./registerAdmin.php">New Admin Account</a>
	            	<a href="./manageUsers.php">Manage Users</a>
	            </nav>
	        </aside>
		</header>
		<div id="list">
			<?php
				getList();
			?>
		</div>
		<section>
			<h3>Add New Image</h3>
			<form action="./imageManager.php" method="post">
				<p>Insert here the name of the animal and the url of the relative image</p>
				<fieldset id="add_form">
					<label for="caption">Image:</label>&nbsp;
					<input id="caption" name="caption" type="text" placeholder="Insert here the name" autofocus><br>
					<label for="url">URL:</label>&emsp;&ensp;
					<input id="url" name="url" type="text" placeholder="Insert here the url">
					<input id ="submit_image" type="submit" class="button" value="Add">
				</fieldset>
			</form>
		</section>
		<section>
			<h3>Delete Image</h3>
			<form action="./deleteImage.php" method="post">
				<p>Insert here the name of the animal to delete</p>
				<fieldset id="delete_form">
					<label for="name">Name:</label>&emsp;
					<input id="name" name="name" type="text" placeholder="Insert here the name">
					<input id ="delete_image" type="submit" class="button" value="Delete">
				</fieldset>
			</form>
		</section>
		<?php
			if (isset($_GET['errorMessage'])){
				echo '<p class="error">';
				echo '<span>' . $_GET['errorMessage'] . '</span>';
				echo '</p>';
			}
		?>
	</body>
</html>