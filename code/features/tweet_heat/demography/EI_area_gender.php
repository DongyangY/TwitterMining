<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_area_gender";
mysqli_query($con,$sql_delete);

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", 
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", 
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", 
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", 
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

$gender = array("male","female");

for($i=0; $i<count($state_name);$i++){
  	for($j = 0; $j < count($gender); $j++){
        $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE location LIKE '%".$state_name[$i]."%' AND users.gender LIKE '%".$gender[$j]."%'"; 
        $result = mysqli_query($con,$sql); 
        while($array = mysqli_fetch_array($result)){
        	echo $array[0]."<br>";

            $sql = "INSERT INTO EI_area_gender(state_name, gender,gender_num) VALUES ('".$state_name[$i]."','".$gender[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($result);
mysqli_close($con);

?>