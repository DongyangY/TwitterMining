<?php

  $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
  $sql_delete = "DELETE FROM EI_state_mood";
  mysqli_query($con,$sql_delete);

  $state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

  //*************take out info from ANEW *********************

  $sql_desc        = "SELECT description FROM ANEW";
  $sql_val_mean    = "SELECT Valence_Mean FROM ANEW";
  $sql_val_sd      = "SELECT Valence_SD FROM ANEW";
  $result_desc     = mysqli_query($con,$sql_desc);
  $result_val_mean = mysqli_query($con,$sql_val_mean);
  $result_val_sd   = mysqli_query($con,$sql_val_sd);

  $k_desc     = 0;
  $k_val_mean = 0;
  $k_val_sd   = 0;

  while($array_desc = mysqli_fetch_array($result_desc)){
    $desc[$k_desc] = $array_desc[0];
    $k_desc++;
  }

  while($array_val_mean = mysqli_fetch_array($result_val_mean)){
    $val_mean[$k_val_mean] = $array_val_mean[0];
    $k_val_mean++;
  }

  while($array_val_sd = mysqli_fetch_array($result_val_sd)){
    $val_sd[$k_val_sd] = $array_val_sd[0];
    $k_val_sd++;
  }

  for($p=0;$p<count($state_name);$p++){  //loop state

    echo $state_name[$p]."<br>";
    $k_tweet=0;
    $sql_tweet = "SELECT tweet_text FROM tweets LEFT JOIN users on tweets.user_id = users.user_id WHERE location LIKE '%".$state_name[$p]."%'";
    $result_tweet = mysqli_query($con,$sql_tweet);

    while($array_related = mysqli_fetch_array($result_tweet)){
      $tweet_related[$k_tweet] = $array_related[0];
      $k_tweet++;
    }
    
    $valid_count  = 0;
    $score_single = 0;
    $score_all    = 0;

    for($i=0;$i<count($tweet_related);$i++){
    //准备进行某一条关键词匹配测试
      $k_match = 0;
      //$test_match=array();       
      for($j=0;$j<count($desc);$j++){
        if(strpos(".$tweet_related[$i].",$desc[$j])){
          $test_match[$k_match]= $j;
          $k_match++;         
        }
      }  
      // echo "k_match numb is:".$k_match."<br>";
      //echo $test_match[1]."<br>";
      //print_r($test_match);
      //$test_match array中放入了匹配当前条的关键词标号
      //print_r($test_match);
      //通过$test_match这里计算的是当前条目的评分数

      //test_match中放入了匹配当前条的关键词标号
      if($k_match > 1){
        $valid_count++;
        $s_scoreall  = 0; 
        $s_weightall = 0;
        //这里计算的是当前条目的评分数
        for($t=0;$t<count($test_match);$t++){
          $s_scoreall += $val_mean[$test_match[$t]]/ $val_sd[$test_match[$t]];
          $s_weightall  += 1 / $val_sd[$test_match[$t]];
          $score_single = $s_scoreall / $s_weightall;
        }
      }
      else{
        $score_single = 0;
      }
        
        //这里 $score_single  是某一条的评分数
        //这里 $score_all  是某了类型的总评分
        $score_all = $score_single + $score_all;  

      } 

      $final = $score_all / $valid_count;
      echo $final."<br>";
      echo $valid_count."<br>";

      $sql = "INSERT INTO EI_state_mood(State_Name,Mood_Value) VALUES ('".$state_name[$p]."',$final)";
      mysqli_query($con,$sql);     
      unset($tweet_related);
    }    //所有state匹配检测结束

  mysqli_close($con);

?>



<!-- $sql = "INSERT INTO EI_state_mood(State_Name,Mood_Value) VALUES ('".$state_name[$p]."',$final)"; -->

<!-- $sql_tweet = "SELECT tweet_text FROM tweets LEFT JOIN users on tweets.user_id = users.user_id WHERE location LIKE '%".$state_name[$p]."%'"; -->