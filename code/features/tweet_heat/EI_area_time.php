<?php

include_once('../../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);

$sql_delete = "DELETE FROM EI_area_time";
mysqli_query($con,$sql_delete);

$state_name = array("overall", "AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE",
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", 
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", 
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", 
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

$date_array = array("%00:%:%", "%01:%:%","%02:%:%", "%03:%:%", "%04:%:%", "%05:%:%", "%06:%:%", "%07:%:%", "%08:%:%", "%09:%:%", "%10:%:%", "%11:%:%", "%12:%:%", "%13:%:%", "%14:%:%", "%15:%:%", "%16:%:%", "%17:%:%", "%18:%:%", "%19:%:%", "%20:%:%", "%21:%:%", "%22:%:%", "%23:%:%");

for($i=0; $i<count($state_name);$i++){
  	for($j = 0; $j < count($date_array); $j++){
        if($state_name[$i] == "overall"){
            $sql = "SELECT count(*) FROM tweets WHERE created_at LIKE '".$date_array[$j]."'";
        }
        else{
            $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE location LIKE '%".$state_name[$i]."%' AND tweets.created_at LIKE '".$date_array[$j]."'";
            }
        $result = mysqli_query($con,$sql);
        while($array = mysqli_fetch_array($result)){
            $sql = "INSERT INTO EI_area_time(time_node, state_name, state_count) VALUES ('".$date_array[$j]."','".$state_name[$i]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

@mysqli_close($result);
@mysqli_close($con);

?>