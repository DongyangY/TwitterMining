<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_type_gender";
mysqli_query($con,$sql_delete);

$type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

$gender = array("male","female");

for($i=0; $i<count($type);$i++){
    for($j = 0; $j < count($gender); $j++){
        $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE tweets.tweet_text LIKE '%".$type[$i]."%' AND users.gender LIKE '%".$gender[$j]."%'"; 
        $result = mysqli_query($con,$sql); 
        while($array = mysqli_fetch_array($result)){
            echo $array[0]."<br>";

            $sql = "INSERT INTO EI_type_gender(type, gender,gender_num) VALUES ('".$type[$i]."','".$gender[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($result);
mysqli_close($con);

?>