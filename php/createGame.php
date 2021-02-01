<?php
	session_start();

	require_once "./util/dbManager.php"; //includes Database Class
	require_once "./util/sessionUtil.php"; //includes Session Utils

		global $DB;

		$dim = $_REQUEST["dim"];

		//selects the max length of the name of an animal
		$query = 'SELECT MAX(LENGTH(caption)) AS max FROM picture';
		$result = $DB->performQuery($query);
		$res = $result->fetch_assoc();

		if($res['max'] < $dim){	//there is not any animal of the given length
			echo '1';
			echo ' ';
			echo '1';
		} else {

			//selects an animal of dim letters
			$query = 'SELECT * FROM picture WHERE LENGTH(caption) = \'' . $dim . '\'';
			$result = $DB->performQuery($query);
			$rows = mysqli_num_rows($result);

			$array = array($rows);	//array con tutti i risultati

			for($j = 0; $j < $rows; $j++){
				$array[$j] = $result->fetch_assoc();
			}
			
			if ($rows > 0){
				$index = rand(0 , $rows-1);	//chooses random animal
				$send = $array[$index];
				echo $send['caption'];
				echo ' ';	//separator
				echo $send['url'];
			} else {
				echo '0';
				echo ' ';
				echo '0';
			}
	    }
?>