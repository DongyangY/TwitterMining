<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
mysqli_query($con,"DELETE FROM freq_state_count");

$sql = "SELECT distinct state_name, screen_name, created_at FROM freq_state";
$result = mysqli_query($con,$sql);
mysqli_query($con,"DELETE FROM freq_state");

while($array = mysqli_fetch_array($result)){
    $sql = "INSERT INTO freq_state(state_name, screen_name, created_at) Values ('".$array[0]."','".$array[1]."','".$array[2]."')";
    mysqli_query($con,$sql);
}

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE",
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA",
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH",
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD",
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

for($j = 0; $j < count($state_name); $j++){

    $sql = "SELECT screen_name, count(screen_name) FROM freq_state WHERE state_name = '".$state_name[$j]."' group by screen_name";
    $result = mysqli_query($con,$sql);

    while($array = mysqli_fetch_array($result)){
        $sql = "INSERT INTO freq_state_count(state_name, screen_name, state_count) Values ('".$state_name[$j]."','".$array[0]."','".$array[1]."')";
        mysqli_query($con,$sql);
    }

}

mysqli_close($con);

?>