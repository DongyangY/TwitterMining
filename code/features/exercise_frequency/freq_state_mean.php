<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
mysqli_query($con,"DELETE FROM freq_state_mean");

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE",
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA",
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH",
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD",
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

for($i = 0; $i < count($state_name); $i++){

    $sql1 = "SELECT AVG(state_count) FROM freq_state_count WHERE state_name LIKE  '%".$state_name[$i]."%'";
    $sql2 = "SELECT MAX(state_count) FROM freq_state_count WHERE state_name LIKE  '%".$state_name[$i]."%'";
    $sql3 = "SELECT STDDEV(state_count) FROM freq_state_count WHERE state_name LIKE  '%".$state_name[$i]."%'";
    $result1 = mysqli_query($con,$sql1);
    $result2 = mysqli_query($con,$sql2);
    $result3 = mysqli_query($con,$sql3);
    echo $exe_type[$i]."<br>";
    while($array1 = mysqli_fetch_array($result1)){
        $ave = (int)$array1[0];
        echo "Ave is:".$ave."<br>";
    }
    while($array2 = mysqli_fetch_array($result2)){
        $max = (int)$array2[0];
        echo "Max is :".$max."<br>";
    }
    while($array3 = mysqli_fetch_array($result3)){
        $std = $array3[0];
        echo "std is :".$std."<br>";
    }

    $sql = "INSERT INTO freq_state_mean(state_name,mean,max,std) VALUES ('".$state_name[$i]."','".$ave."','".$max."','".$std."')";

    mysqli_query($con,$sql);
}
?>