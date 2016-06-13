<?php
function number($str) {
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
?>