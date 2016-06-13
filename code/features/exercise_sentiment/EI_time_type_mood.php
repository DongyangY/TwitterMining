<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_time_type_mood";
mysqli_query($con,$sql_delete);

$exercise_type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");
$date_array = array("%00:%:%","%01:%:%","%02:%:%", "%03:%:%","%04:%:%","%05:%:%", "%06:%:%","%07:%:%","%08:%:%", "%09:%:%","%10:%:%","%11:%:%", "%12:%:%","%13:%:%","%14:%:%","%15:%:%", "%16:%:%", "%17:%:%","%18:%:%","%19:%:%","%20:%:%", "%21:%:%","%22:%:%","%23:%:%");
//*************take out info from ANEW ********************************************
$sql1 = "SELECT description FROM ANEW";
$sql2 = "SELECT Valence_Mean FROM ANEW";
$sql3 = "SELECT Valence_SD FROM ANEW";
$result1 = mysqli_query($con,$sql1);
$result2 = mysqli_query($con,$sql2);
$result3 = mysqli_query($con,$sql3);

$k1=0; $k2=0; $k3=0;
/// $test1 is all description work, 
while($array1 = mysqli_fetch_array($result1)){
  $desp[$k1] = $array1[0];
  $k1++;
}
//// $test2 is all responding valence_mean
while($array2 = mysqli_fetch_array($result2)){
  $valence_mean[$k2] = $array2[0];
  $k2++;
}
/// $test3 is  all responding Valence_SD
while($array3 = mysqli_fetch_array($result3)){
  $Valence_SD[$k3] = $array3[0];
  $k3++;
}
//***************************************************************
//***************************************************************
//***************************************************************
//***************************************************************

// $test4 is all related type tweets!!!
for($q=0;$q<count($exercise_type);$q++){   //loop exercise type
  for($p=0;$p<count($date_array);$p++){  //loop date

    $k4=0;
    $sql4 = "SELECT tweet_text FROM tweets WHERE created_at LIKE 
    '%".$date_array[$p]."%'AND tweet_text LIKE '%".$exercise_type[$q]."%'";

    $result4 = mysqli_query($con,$sql4);

    while($array4 = mysqli_fetch_array($result4)){
            $tweets[$k4] = $array4[0];
            //echo $tweets[$k4]."<br>";
            $k4++;
     }

 ///按照时间顺序将对应时间的所有tweets存到$tweets数组中,12：00--23：00全部正常输出，通过测试。
    
    $s5=0;  $Effect_k5 = 0;// $Effect_k5 关键词大于2的总tweets数
    //echo count($tweets);
    //unset($tweets);


    for($i=0;$i<count($tweets);$i++){
    //准备进行某一条关键词匹配测试
         $k5=0;
         //$desp_key=array();
     
      for($j=0;$j<count($desp);$j++){
     
        if(strpos(".$tweets[$i].",$desp[$j])){
          $desp_key[$k5]= $j;
        
          $k5++;
         
        }
      }  
       // echo "k5 numb is:".$k5."<br>";
      //echo $desp_key[1]."<br>";
       //print_r($desp_key);
//$desp_key array中放入了匹配当前条的关键词标号
        //print_r($desp_key);
//通过$desp_key这里计算的是当前条目的评分数
       $EX_all=0; $Val_SD=0;  $Val_SD_weight=0; 
      // 一句tweets中匹配关键词数大于一的个数
         
        if($k5>1){
          $Effect_k5++;
          for($t=0;$t<count($desp_key);$t++){
           
            $Val_SD_weight = (1 / $Valence_SD[$desp_key[$t]]) * 0.39894;
       
            $EX_all+= $valence_mean[$desp_key[$t]] * $Val_SD_weight ;
       
            $Val_SD +=  $Val_SD_weight;
        
     

          }
          $EX_single = $EX_all / $Val_SD; 
          //echo $EX_single."<br>";
          //得到某一条tweets的评分,0.39894
          
          $s5 += $EX_single;//$s5记录某个时间段所有tweets的评分和

        }  
        
         unset($desp_key);
      //单条tweets匹配检测结束
        
   
       
     }  //某个时间段所有tweets匹配检测结束
    //echo "effect k5 is :".$Effect_k5."<br>";
     $final = $s5/$Effect_k5;
     echo $final;
     $sql = "INSERT INTO EI_time_type_mood(Type,Time,Mood_Value) VALUES ('".$exercise_type[$q]."','".$date_array[$p]."',$final)";
     mysqli_query($con,$sql);
     unset($tweets);
  }    //所有时间段匹配检测结束
}
mysqli_close($con);

?>