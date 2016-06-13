<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");


//*************take out info from ANEW *********************************************
$sql1 = "SELECT description FROM ANEW";
$sql2 = "SELECT Valence_Mean FROM ANEW";
$sql3 = "SELECT Word_Frequency FROM ANEW";
$result1 = mysqli_query($con,$sql1);
$result2 = mysqli_query($con,$sql2);
$result3 = mysqli_query($con,$sql3);

$k1=0; $k2=0; $k3=0;
/// $test1 is all description work, 
while($array1 = mysqli_fetch_array($result1)){
  $test1[$k1] = $array1[0];
  $k1++;
}
//// $test2 is all responding valence_mean
while($array2 = mysqli_fetch_array($result2)){
  $test2[$k2] = $array2[0];
  $k2++;
}
/// $test3 is  all responding word_frequency
while($array3 = mysqli_fetch_array($result3)){
  $test3[$k3] = $array3[0];
  $k3++;
}
//***************************************************************
//***************************************************************
//***************************************************************
//***************************************************************



   $tweet_num=0;
	$sql4 = "SELECT tweets FROM testtweets";

    $result4 = mysqli_query($con,$sql4);

    while($array4 = mysqli_fetch_array($result4)){
            $tweets[$tweet_num] = $array4[0];
               
            $tweet_num++;

     }

     $mood_sum=0;   $Effect_tweet=0;
    for($i=0;$i<count($tweets);$i++){
    /////test single tweet
         $lable=0;
         $match_lable=array();
     //echo $tweets[$i]."<br>";
        
	    for($j=0;$j<count($test1);$j++){
		 
         // match single keyword in table 1
		    if(strpos(".$tweets[$i].",$test1[$j])){
      
			     $match_lable[$lable]= $j;
			     $lable++;
		    }
      }
//test5中放入了匹配当前条的关键词标号
      //echo "lable is :".$lable."<br>";
       $s1=0; $s2=0;
//这里计算的是当前条目的评分数
    

     if($lable>0){
       $Effect_tweet++;
        //echo "effect is:".$Effect_tweet."<br>";

       for($t=0;$t<count($match_lable);$t++){
       
         $s1 += $test2[$match_lable[$t]]* $test3[$match_lable[$t]];
         $s2 += $test3[$match_lable[$t]];
       
        
       }
        $single_value = $s1 / $s2;
         
         echo "<br>";
      } else{
        $single_value=0;
      }
echo "mood value of tweet:  ".$tweets[$i]." is ".$single_value."<br>"; 
//这里 $single_value is mood value of a single tweet

      $mood_sum=$single_value+$mood_sum;
      echo "mood sum is:".$mood_sum."<br>";
        
       
    } 
    echo "effect is:".$Effect_tweet."<br>";

      $final = $mood_sum/$Effect_tweet;
    
   
   
echo "the average mood value of test tweets is ".$final;
mysqli_close($con);

?>