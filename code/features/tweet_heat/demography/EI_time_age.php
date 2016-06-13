<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_type_age";
mysqli_query($con,$sql_delete);

$type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

$age = array("<15","15-24","25-34","35-44","45-54","55-64",">65");

for($i=0; $i<count($type);$i++){
    for($j = 0; $j < count($age); $j++){
        $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE tweets.tweet_text LIKE '%".$type[$i]."%' AND users.age LIKE '%".$age[$j]."%'"; 
        $result = mysqli_query($con,$sql); 
        while($array = mysqli_fetch_array($result)){
            echo $array[0]."<br>";

            $sql = "INSERT INTO EI_type_age(type, age,age_num) VALUES ('".$type[$i]."','".$age[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($result);
mysqli_close($con);

?>