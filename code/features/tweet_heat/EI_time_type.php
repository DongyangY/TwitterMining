<?php

$date_array = array("%00:%:%", "%01:%:%","%02:%:%", "%03:%:%", "%04:%:%", "%05:%:%", "%06:%:%", "%07:%:%", "%08:%:%", "%09:%:%", "%10:%:%", "%11:%:%", "%12:%:%", "%13:%:%", "%14:%:%", "%15:%:%", "%16:%:%", "%17:%:%", "%18:%:%", "%19:%:%", "%20:%:%", "%21:%:%", "%22:%:%", "%23:%:%");
$type_array = array("overall", "running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

include_once('../../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);
    
$sql = "DELETE FROM EI_time_type";
mysqli_query($con, $sql);

function update($date,$type,$i,$con){
  
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    }

    if($type == "overall"){
        $sql = "SELECT COUNT(*) FROM tweets WHERE created_at LIKE '".$date."'";
        $result = mysqli_query($con, $sql);
        while($array = mysqli_fetch_array($result)){
            $num = $array[0];
        }

        $sql = "INSERT INTO EI_time_type(exercise_type, time_node, time_count) VALUES ('overall".$i."','".$date."',".$num.")";
        mysqli_query($con, $sql);
    }
    else{
        $sql = "SELECT COUNT(*) FROM tweets WHERE created_at LIKE '".$date."' AND tweet_text LIKE '%".$type."%'";
        $result = mysqli_query($con, $sql);
        while($array = mysqli_fetch_array($result)){
            $num = $array[0];
        }
   
        $sql = "INSERT INTO EI_time_type(exercise_type, time_node, time_count) VALUES ('".$type.$i."','".$date."',".$num.")";
        mysqli_query($con, $sql);
    }
}



for($j=0; $j < count($type_array); $j++){
    for ($i=0; $i < count($date_array); $i++){
        update($date_array[$i], $type_array[$j],$i,$con);
    }
}

@mysqli_close($result);
@mysqli_close($con);

?>