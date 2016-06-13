<?php

include_once('../../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);

$sql_delete = "DELETE FROM food_type";
mysqli_query($con,$sql_delete);

$exercise_type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");
$exercise_type_count = count($exercise_type);
$food_type = array("apple", "banana", "lemon", "orange", "pear", "milk", "meat", "vegetable");
$food_type_count = count($food_type);

for($i=0;$i< $food_type_count;$i++){ 
    for($j = 0; $j < $exercise_type_count; $j++){
        $sql = "SELECT count(*) FROM tweets WHERE tweet_text LIKE '%".$exercise_type[$j]."%' AND tweet_text LIKE '%".$food_type[$i]."%'"; 
        $result = mysqli_query($con,$sql); 
 
        while($array = mysqli_fetch_array($result)){
            $sql = "INSERT INTO food_type(food_type, exercise_type, exercise_count) VALUES ('".$food_type[$i]."','".$exercise_type[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

@mysqli_close($result);
@mysqli_close($con);

?>