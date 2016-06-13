<?php

include_once('../../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);
    
 mysqli_query($con,"DELETE FROM Etime_state");

 $state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", 
 	"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", 
 	"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", 
 	"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", 
 	"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");
 //$exercisetype = array ("run","swim","basketball","football");

define("EXERCISETIME","200");
 //************ Average Time Function*************//

function number($str){
  return preg_replace ('/\D/s', '', $str);
}

function extractnum($string){
  //calculate mins
  $pos_min = strpos("$string","min");
    $str_min = substr($string, $pos_min-4, 4); 
    $num_min = number ($str_min);
    $num_min_int = (int)$num_min;
    
    //caculate hours
    $pos_hr = strpos("$string","hr");
    $str_hr = substr($string, $pos_hr-4, 4);
    $num_hr = number($str_hr);
    $num_hr_int = (int)$num_hr;
    // judge if hours exsist
    if ($num_hr_int != 0){
      $num_hr_min = $num_hr_int*60;
    }else{$num_hr_min = 0;}


    $num_min_sum = $num_min_int + $num_hr_min;

 return $num_min_sum;
}

//*****************************************//

 //for ($i = 0; $i < count ($exercisetype);$i++){
for($j = 0; $j < count($state_name); $j++){

      $sql = "SELECT tweets.tweet_text FROM tweets LEFT JOIN users on tweets.user_id = users.user_id WHERE location LIKE
      '%".$state_name[$j]."%' AND 
       tweets.tweet_text LIKE '%min%'"; 
 //echo $state_name[$j];
 //echo $date_array[$i];
        $result = mysqli_query($con,$sql); 

         while($array = mysqli_fetch_array($result)){
           echo "state name is:".$state_name[$j];
           echo "<br>";
 	         echo "tweets is:".$array[0];
 	         echo "<br>";
           $num = extractnum($array[0]);
           echo "extract num is:". $num. "<br>"; 
           
  /*if(!$result1 = 0){
    $sql = "INSERT INTO ExerciseTime(state_name,exercise_date,exercise_time) Values ('".$state_name[$j]."','"tweets.created_at"','"$result1"')";
        mysqli_query($con,$sql);
  }*/
           if($num != 0 && $num < 200 ){


          
             $sql = "INSERT INTO Etime_state(state_name, exercise_time) Values('".$state_name[$j]."',".$num.")";
             mysqli_query($con,$sql);
              echo"int is :". $num."<br>";
            } 
           else {echo "the int is out of scope"."<br>";
            }

  
        }
}
 
 @mysqli_close($con);
?>