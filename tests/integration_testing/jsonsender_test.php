<?php

	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = 'wearethebest';
	$db_name = 'hma2014';

	$id = 1;
	$who = 1;

	header('Cache-Control: no-cache, must-revalidate');
	header('Content-type: application/json');
	include_once('../database/db_config.php');
	$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);

	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	switch($who){
		case 0:
			echo "It is the IOS device requesting data!"."<br>";
			break;
		case 1:
			echo "It is the website requesting data!"."<br>";
			break;		
		}

	switch($id){
		case 0:
			$sql = "SELECT * FROM EI_area_overall";
			echo "Table 0 is selected to be sent!"."<br>";
			break;
		case 1:
			$sql = "SELECT * FROM jsonsender_test";
			echo "Table 1 is selected to be sent!"."<br>";
			break;
	}

	if ($result = mysqli_query($con, $sql)){
		$resultArray = array();
		$tempArray = array();
		
		while($row = $result->fetch_object()){
			$tempArray = $row;
			array_push($resultArray, $tempArray);
		}
		echo json_encode($resultArray);
	}

	@mysqli_close($result);
	@mysqli_close($con);

?>