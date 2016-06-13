<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_time_gender";
mysqli_query($con,$sql_delete);

$date_array = array("%00:%:%","%01:%:%","%02:%:%", "%03:%:%","%04:%:%","%05:%:%", "%06:%:%","%07:%:%","%08:%:%", "%09:%:%","%10:%:%","%11:%:%", "%12:%:%","%13:%:%","%14:%:%","%10:%:%","%15:%:%", "%16:%:%", "%17:%:%","%18:%:%","%19:%:%","%20:%:%", "%21:%:%","%22:%:%","%23:%:%");

$gender = array("male","female");

for($i=0; $i<count($date_array);$i++){
    for($j = 0; $j < count($gender); $j++){
        $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE tweets.created_at LIKE '%".$date_array[$i]."%' AND users.gender LIKE '%".$gender[$j]."%'"; 
        $result = mysqli_query($con,$sql); 
        while($array = mysqli_fetch_array($result)){
            echo $array[0]."<br>";

            $sql = "INSERT INTO EI_time_gender(time, gender,gender_num) VALUES ('".$date_array[$i]."','".$gender[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($result);
mysqli_close($con);

?>