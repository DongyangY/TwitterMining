<?php

 $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
 mysqli_query($con,"DELETE FROM testtweets");
 
 $testtweets = array("Bouta get this 4 min mile for this color run", 
 	"@LisaGatDell The Shuttles for #DellWorld run every 15 min on Tuesday from 5PM to 9PM #DellWorldHelp",
 	"Cant believe I am saying this, but I really wish we were going on another 20 min run tomorrow",
 	"90 min run with @ironman930 banked! Kids sport now! Nearly @nycmarathon time! Pumped",
 	"Lasagna prepped & in the oven leaving me 45 min to workout and run. Thanks for my new workout shirt @StrideFitAparel",
 	"42 min off road run, do yourself a favour have a run round harewood house, it is class & FREE #ChallengeYourself #usn",
 	" @Mirindacarfrae is 11 min back in T2. Last yr it was 12. Come on Rinny, you own the run! Here is proof from last yr",
 	"#IMKona update: Sebastian Kienle off the bike & into the run w a strong four min lead. 4hrs20mins for 112miles. Not bad!",
 	"Day 1 #gebabybootcamp 15 min Run 300 sit-ups, Stretch",
 	"Only have 30 min? Run for 15 min & then turn around and run back. Better make it in time");
 
 for($i = 0; $i < count($testtweets);$i++){
    echo $testtweets[$i]."<br>";
    $sql_insert = "INSERT INTO testtweets(tweets) VALUE ('".$testtweets[$i]."')";
    mysqli_query($con,$sql_insert);
 }


  mysqli_close($con);

 ?>