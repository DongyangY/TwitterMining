<?php

 $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
 
 //************ Average Time Function*************//

function number($str){
  return preg_replace ('/\D/s', '', $str);
} // get numbers within a string

//get minutes in a tweets
function extractnum($string){
 
    $pos_min = strpos("$string","min");  // choose the position of keyword "min"
    $str_min = substr($string, $pos_min-3, 3); // intercept a string from position from the position that  back to 4 characters of min to min
    $num_min = number ($str_min); // Get numbers within the intercepted strings
    $num_min_int = (int)$num_min; // get int min number
    
    //caculate hour (keywords hr)
    $pos_hr = strpos("$string","hr");
    $str_hr = substr($string, $pos_hr-3, 3);
    $num_hr = number($str_hr);
    $num_hr_int1 = (int)$num_hr;
   
    //caculate hour (keywords hour)
    $pos_hour = strpos("$string","hour");
    $str_hour = substr($string, $pos_hour-3, 3);
    $num_hour = number($str_hour);
    $num_hr_int2 = (int)$num_hour;
    
    //total exercise hour
    $num_hr_int = $num_hr_int1 + $num_hr_int2;

    // judge if hours exsist
    if ($num_hr_int != 0){
      $num_hr_min = $num_hr_int*60;
    }else{$num_hr_min = 0;}


    $num_min_sum = $num_min_int + $num_hr_min;

 return $num_min_sum;
}

//*****************************************//

// loop check exercise time  of each tweets 
       
      
 
      $sql = "SELECT tweets FROM testtweets";

      $result = mysqli_query($con,$sql); 

      while($array = mysqli_fetch_array($result)){
          
           echo "test tweets is:".$array[0];
           echo "<br>";
           $num = extractnum($array[0]);
           
           echo "num first extracted is:".$num."<br>";
           
      // limit maximum exercise time considered on normal conditions
           if($num != 0 && $num < 300 ){
              echo "exercise time is:". $num."mins" ."<br>"; 
            } 
           else {echo "the time is out of scope"."<br>";
            }

  
     }

 
 mysqli_close($con);
?>