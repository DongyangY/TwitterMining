<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
mysqli_query($con,"DELETE FROM freq_type_count");

$sql = "SELECT distinct exercise_type, screen_name, created_at FROM freq_type";
$result = mysqli_query($con,$sql);
mysqli_query($con,"DELETE FROM freq_type");

while($array = mysqli_fetch_array($result)){
    $sql = "INSERT INTO freq_type(exercise_type, screen_name, created_at) Values ('".$array[0]."','".$array[1]."','".$array[2]."')";
        mysqli_query($con,$sql);
}

$Exe_type = array("running","cycling","swimming","basketball","volleyball","tennis","football");

for($j = 0; $j < count($Exe_type); $j++){

    $sql = "SELECT screen_name, count(screen_name) FROM freq_type WHERE exercise_type = '".$Exe_type[$j]."' group by screen_name";
    $result = mysqli_query($con,$sql);

    while($array = mysqli_fetch_array($result)){
        $sql = "INSERT INTO freq_type_count(exercise_type, screen_name, exercise_count) Values ('".$Exe_type[$j]."','".$array[0]."','".$array[1]."')";
        mysqli_query($con,$sql);
    }

}

mysqli_close($con);

?>