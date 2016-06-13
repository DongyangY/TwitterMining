<?php

include_once('../../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);

mysqli_query($con, "delete from lb_type");

$exercise_type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");
    
/******The section aims at select useful information from tweet_text and insert them into the new table *******/


for($i=0; $i<count($exercise_type); $i++){
    
    $sql = "SELECT COUNT(*) as num, screen_name, profile_image_url FROM tweets WHERE tweet_text LIKE '%".$exercise_type[$i]."%' GROUP BY screen_name ORDER BY num DESC LIMIT 15";

    $result= mysqli_query($con,$sql);

    echo "<br>".$exercise_type[$i]."<br>";
    
    $m = 0;
    
    while($array = mysqli_fetch_array($result)){
        $num = $array[0];
        $name =$array[1];
        $url = $array[2];

        echo $name."   ".$num."<br>";

        mysqli_query($con,"INSERT INTO lb_type (exercise_type, screen_name, tweet_num, profile_image_url) VALUES ('".$exercise_type[$i]."','".$name."',".$num.",'".$url."')");
        
        $m++;

    }
    //if a certain fields has less than 15 tweet texts, set its rest information as zero

    if($m < 15){
        for($n=0;$n<(15-$m);$n++) mysqli_query($con,"INSERT INTO lb_type (exercise_type, screen_name, tweet_num, profile_image_url) VALUES ('".$exercise_type[$i]."','no data',0,'no data')");
    }
    
}

@mysqli_close($result);
@mysqli_close($con);

?>