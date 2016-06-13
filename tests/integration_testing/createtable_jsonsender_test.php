<?php

	$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

	$sql_create_table="CREATE TABLE if not exists jsonsender_test(
		test_name varchar(40),
		test_num int(20)
  ) ";
	        
	if (mysqli_query($con, $sql_create_table)){
		echo "jsonsender_test table is created successfully!";
		echo '<br>';
	}
	else{
		echo "error:".mysqli_error($con);
	}

	$sql_delete = "DELETE FROM jsonsender_test";
	mysqli_query($con,$sql_delete);

	$test_name = array();
	$test_num = array();
	$test_name = ["Hohn", "Kathy", "Alex", "Jason"];
	$test_num = [1, 2, 3, 4];

	for($i = 0; $i < count($test_name); $i++){ 
		$sql_insert = "INSERT INTO jsonsender_test(test_name,test_num) VALUES ('".$test_name[$i]."', ".$test_num[$i].")";
		mysqli_query($con, $sql_insert);
	}

	echo "Insert jsonsender_test data complete!";
	echo '<br>';

	mysqli_close($con);
?>
 
