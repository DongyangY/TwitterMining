<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM demography";
mysqli_query($con,$sql_delete);

$age = array("<15","15-24","25-34","35-44","45-54","55-64",">65");
$gender = array("MALE","FEMALE");

for($j = 0; $j < count($gender); $j++){
    $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE gender = '".$gender[$j]."'";
    $result = mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)){
        echo $array[0]."<br>";
            
        $sql = "INSERT INTO demography(gender_age, demography_count) VALUES ('".$gender[$j]."',".$array[0].")";
        mysqli_query($con,$sql);
    }
}
    
for($j = 0; $j < count($age); $j++){
    $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE age = '".$age[$j]."'";
    $result = mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)){
        echo $array[0]."<br>";
        
        $sql = "INSERT INTO demography(gender_age, demography_count) VALUES ('".$age[$j]."',".$array[0].")";
        mysqli_query($con,$sql);
    }
}


mysqli_close($result);
mysqli_close($con);

?>