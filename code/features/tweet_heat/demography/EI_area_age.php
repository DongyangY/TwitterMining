<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_area_age";
mysqli_query($con,$sql_delete);

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", 
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", 
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", 
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", 
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

$age = array("<15","15-24","25-34","35-44","45-54","55-64",">65");

for($i=0; $i<count($state_name);$i++){
  	for($j = 0; $j < count($age); $j++){
        $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE location LIKE '%".$state_name[$i]."%' AND users.age LIKE '%".$age[$j]."%'"; 
        $result = mysqli_query($con,$sql); 
        while($array = mysqli_fetch_array($result)){
        	echo $array[0]."<br>";

            $sql = "INSERT INTO EI_area_age(state_name, age,age_num) VALUES ('".$state_name[$i]."','".$age[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($result);
mysqli_close($con);

?>