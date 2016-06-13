<?php

include_once('../../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);
    
mysqli_query($con, "delete from leaderboard_overall");
    
/******The section aims at select useful information from tweet_text and insert them into the new table *******/


$sql = "SELECT COUNT(*) as num, screen_name, profile_image_url FROM tweets group by screen_name order by num DESC limit 15";

$result= mysqli_query($con,$sql);

while($array = mysqli_fetch_array($result)){
    $num = $array[0];
    $name =$array[1];
    $url = $array[2];
    mysqli_query($con,"INSERT INTO leaderboard_overall (screen_name, tweet_num, profile_image_url) VALUES ('".$name."',".$num.",'".$url."')");

}

@mysqli_close($result);
@mysqli_close($con);

?>