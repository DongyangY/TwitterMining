<?php

$date_array = array("2014-10-13%", "2014-10-14%", "2014-10-15%", "2014-10-16%", "2014-10-17%", "2014-10-18%", "2014-10-19%");

include_once('../../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);
$sql = "DELETE FROM EI_time_overall";
mysqli_query($con, $sql);

function update1($date,$con){
  
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    }

    $sql = "SELECT COUNT(*) FROM tweets WHERE created_at LIKE '".$date."'";
    $result = mysqli_query($con, $sql);
    while($array = mysqli_fetch_array($result)){
        $num = $array[0];
    }
   
    $sql = "INSERT INTO EI_time_overall(time_node, time_count) VALUES ('".$date."',".$num.")";
    mysqli_query($con, $sql);
}

for ($i=0; $i < count($date_array); $i++){
    update1($date_array[$i],$con);
}

@mysqli_close($result);
@mysqli_close($con);

?>