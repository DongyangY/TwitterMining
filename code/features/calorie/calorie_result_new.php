<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
mysqli_query($con,"DELETE FROM calorie_result_new");

$date_array = array("2014-12-01%", "2014-12-02%", "2014-11-29%", "2014-11-30%");

$time_array = array("%00:%:%", "%01:%:%","%02:%:%", "%03:%:%", "%04:%:%", "%05:%:%", "%06:%:%", "%07:%:%", "%08:%:%", "%09:%:%", "%10:%:%", "%11:%:%", "%12:%:%", "%13:%:%", "%14:%:%", "%15:%:%", "%16:%:%", "%17:%:%", "%18:%:%", "%19:%:%", "%20:%:%", "%21:%:%", "%22:%:%", "%23:%:%");

$workday = array(array());
$workday_caloire = array();

$weekday = array(array());
$weekday_caloire = array();

$exercise_type = array("ran","rode","swam","basketball","football");
$type_weight = array(7.1, 3.2, 8.4, 5.1, 1.5);
$type_calorie = array(472, 502, 590, 472, 531);


for($i = 0; $i < count($exercise_type); $i++){
    
    for($j = 0; $j < count($time_array); $j++){
        
        $sql = "SELECT AVG(exercise_time) FROM calorie_new WHERE exercise_type = '".$exercise_type[$i]."' AND created_at LIKE '".$time_array[$j]."' AND (created_at LIKE '".$date_array[0]."' OR created_at LIKE '".$date_array[1]."')";
        
        $result = mysqli_query($con,$sql); 
        while($array = mysqli_fetch_array($result)){
            $workday[$i][$j] = $array[0];
        }
        
    }
} 

for($j = 0; $j < count($time_array); $j++){
    for($i = 0; $i < count($exercise_type); $i++){
        $workday[$i][$j] = $workday[$i][$j] * $type_calorie[$i] * $type_weight[$i]; 
    }
    $workday_caloire[$j] = ($workday[0][$j] + $workday[1][$j] + $workday[2][$j] + $workday[3][$j] + $workday[4][$j]) / ($type_weight[0] + $type_weight[1] + $type_weight[2] + $type_weight[3] + $type_weight[4]);

}


for($i = 0; $i < count($exercise_type); $i++){

    for($j = 0; $j < count($time_array); $j++){

        $sql = "SELECT AVG(exercise_time) FROM calorie_new WHERE exercise_type = '".$exercise_type[$i]."' AND created_at LIKE '".$time_array[$j]."' AND (created_at LIKE '".$date_array[2]."' OR created_at LIKE '".$date_array[3]."')";

        $result = mysqli_query($con,$sql);
        while($array = mysqli_fetch_array($result)){
            $weekday[$i][$j] = $array[0];
        }

    }
}

for($j = 0; $j < count($time_array); $j++){
    for($i = 0; $i < count($exercise_type); $i++){
        $weekday[$i][$j] = $weekday[$i][$j] * $type_calorie[$i] * $type_weight[$i];
    }
    $weekday_caloire[$j] = ($weekday[0][$j] + $weekday[1][$j] + $weekday[2][$j] + $weekday[3][$j] + $weekday[4][$j]) / ($type_weight[0    ] + $type_weight[1] + $type_weight[2] + $type_weight[3] + $type_weight[4]);

}

for($j = 0; $j < count($time_array); $j++){
    $sql = "INSERT INTO calorie_result_new(workday, time, calorie) VALUES ( 1,".$j.",".$workday_caloire[$j].")";
    mysqli_query($con,$sql);
}

for($j = 0; $j < count($time_array); $j++){
    $sql = "INSERT INTO calorie_result_new(workday, time, calorie) VALUES ( 0,".$j.",".$weekday_caloire[$j].")";
    mysqli_query($con,$sql);
}


@mysqli_close($result);
@mysqli_close($con);
?>