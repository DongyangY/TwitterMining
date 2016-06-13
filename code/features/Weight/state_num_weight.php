<?php
 include ('Followers_Weight_Function.php');
 include ('count_ex_min.php');

 $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
 mysqli_query($con,"DELETE FROM Exercisetime_State");

 $state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");
    
 for($j = 0; $j < count($state_name); $j++){

      $sql = "SELECT tweets.tweet_text, users.followers_count FROM tweets LEFT JOIN users on tweets.user_id = users.user_id WHERE location LIKE
      '%".$state_name[$j]."%' AND 
       tweets.tweet_text LIKE '%min%'"; 

        $result = mysqli_query($con,$sql); 

         while($array = mysqli_fetch_array($result)){
           $num = extractnum($array[0]);
           echo "state name is:".$state_name[$j];
           echo "<br>";
 	         echo "tweets is:".$array[0];
 	         echo "<br>";
           echo "extract num is:". $num. "<br>"; 
           echo "follower number is:".$array[1]."<br>";
           
          
          $weight = Weight_follower($array[1]); 
          //ExTime_Weight_Efficient
          echo "weight is:".$weight."<br>";


           if($num != 0 && $num < 200 ){

              $sql = "INSERT INTO ExerciseTime_State(state_name,exercise_time) Values ('".$state_name[$j]."','".$num."')";
              echo"int is :". $num."<br>";
            } 
           else {echo "the int is out of scope"."<br>";
            }

          
          mysqli_query($con,$sql);
  
        }
}
 
 mysqli_close($con);
?>