<?php

//IOS uses post method while website and Android use get methods
//If you want to use IOS, please remove the comment for the code below
/*
$who=$_GET['who'];

if($who==1) $id=$_GET['id'];
else{
    $id=$_POST['id'];
    $usr=$_POST['usr'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $state=$_POST['state'];
    $exercise=$_POST['exercise'];
}
*/

$id=$_GET['id'];
    
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');
include_once('../database/db_config.php');
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

switch($id){

case 0:
    $sql = "SELECT * FROM EI_area_overall";break;
case 1:
    $sql = "SELECT * FROM EI_type_overall";break;
case 2:
    $sql = "SELECT * FROM EI_time_type";break;
case 3:
    //$sql = "SELECT screen_name, tweet_text, geo_lat, geo_long, profile_image_url FROM tweets WHERE geo_lat != 0.00000 AND geo_long != 0.00000 ORDER BY tweet_id DESC LIMIT 5";break;
    $sql = "SELECT screen_name, geo_lat, geo_long, profile_image_url FROM tweets 
    WHERE geo_lat BETWEEN 24.00000 AND 49.00000 AND geo_long BETWEEN -124.00000 AND -67.00000
    ORDER BY tweet_id DESC LIMIT 1000";break;

    //$sql = "SELECT tweet_text FROM tweets WHERE tweet_id = 521494947103387648";break;
case 4:
    $sql = "SELECT * FROM EI_time_overall";break;
case 5:
    $sql = "SELECT * FROM leaderboard_overall";break;
case 6:
    require_once('../database/db_lib.php');
    include_once('../database/twitteroauth/twitteroauth.php');
    define('API_KEY', 'N52DOuXGSqJvPDAhqclJtlAli');
    define('API_SECRET', 'VoReVCHdfx5Nmfzdf5GJQe9F8Sa5d7MAiZIQNc0MGd8gxnUc8l');
    define('ACCESSTOKEN', '2796206664-VgDlTzBQYMhcCuO4zFBlS5HNsfEEwCwmBOKLzvN');
    define('ACCESSTOKEN_SECRET', 'yxD1zKrZSnFjpO0pEtxczKIeBPRrGQCbrkNkVgpIMIWNk');
    $twitter = new TwitterOAuth(API_KEY, API_SECRET, ACCESSTOKEN, ACCESSTOKEN_SECRET);
    $tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=from%3A'.$usr.'&result_type=recent&count=200');
    $sql = "delete from user_profiles where user_name = '".$usr."'";
    mysqli_query($con,$sql);
    $sql = "delete from user_profiles_tweets where user_name = '".$usr."'";
    mysqli_query($con,$sql);
    $image = "";
    foreach($tweets as $v1){
        foreach($v1 as $v2){
            if($v2->text){
                $image = $v2->user->profile_image_url;
                $oDB = new db;
                $date = $oDB->date($v2->created_at);
                $sql = "INSERT INTO user_profiles_tweets(user_name,tweet_text,created_at) VALUES ('".$usr."','".$v2->text."','".$date."')";
                mysqli_query($con,$sql);
            }
            
        }
    }
    $sql = "INSERT INTO user_profiles(user_name,profile_image_url,state_name, gender, age, exercise) VALUES ('".$usr."','".$image."','".$state."','".$gender."','".$age."','".$exercise."')";
    mysqli_query($con,$sql);
    $sql = "SELECT * FROM user_profiles where user_name = '".$usr."'";
    break;
case 7:
    $sql = "SELECT * FROM EI_area_time";break;
case 8:
    $sql = "SELECT * FROM EI_area_type";break;
case 9:
    $sql = "SELECT * FROM lb_area";break;
case 10:
    $sql = "SELECT * FROM lb_type";break;
case 11:
    $sql = "SELECT * FROM Etime_state_mean";break;
case 12:
    $sql = "SELECT * FROM Etime_type_mean";break;
case 13:
        
    $sql = "delete from suggestion where user_name = '".$usr."'";
    mysqli_query($con,$sql);
        
    $sql = "SELECT mean, max FROM Etime_state_mean where state_name = '".$state."'";
    $result= mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)){
        $exercise_time = $array[0];
        $exercise_time_max =$array[1];
    }
    
    $sql = "SELECT mean, max FROM freq_type_mean where exercise_type = '".$exercise."'";
    $result= mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)){
        $exercise_freq = $array[0];
        $exercise_freq_max =$array[1];
    }
        
    $sql = "SELECT food_type, state_count FROM food_state where state_name = '".$state."' order by state_count";
    $result= mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)){
        $food_state = $array[0];
    }
        
    $sql = "SELECT food_type, exercise_count FROM food_type where exercise_type = '".$exercise."' order by exercise_count";
    $result= mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)){
        $food_exercise = $array[0];
    }
        
    $sql = "INSERT INTO suggestion(user_name,exercise_time,exercise_time_max,exercise_freq,exercise_freq_max, food_state,food_exercise) VALUES ('".$usr."','".$exercise_time."','".$exercise_time_max."','".$exercise_freq."','".$exercise_freq_max."','".$food_state."','".$food_exercise."')";
    mysqli_query($con,$sql);
        
    $sql = "SELECT * FROM suggestion where user_name = '".$usr."'";break;
case 14:
    $sql = "SELECT * FROM user_profiles_tweets where user_name = '".$usr."' order by created_at DESC";break;
case 15:
    $sql = "SELECT * FROM Etime_type 
    WHERE geo_lat BETWEEN 24.00000 AND 48.00000 AND geo_long BETWEEN -120.00000 AND -67.00000 
    order by tweet_id DESC LIMIT 500";break;
case 16:
    $sql = "SELECT * FROM Mood_state";break;
case 17:
    $sql = "SELECT * FROM exercise_to_health order by duration";break;
case 18:
    $sql = "SELECT * FROM freq_type_mean";break;
case 19:
    $sql = "SELECT * FROM food_type";break;
case 20:
    $sql = "SELECT * FROM food_state";break;
case 21:
    $sql = "SELECT * FROM demography";break;
case 22:
    $sql = "SELECT * FROM calorie_result";break;
case 23:
    $sql = "SELECT * FROM calorie_result_new";break;

case 24:
    $sql = "SELECT screen_name, geo_lat, geo_long, profile_image_url FROM tweets 
    WHERE geo_lat BETWEEN 39.40000 AND 41.60000 AND geo_long BETWEEN -75.50000 AND -73.40000
    ORDER BY tweet_id DESC LIMIT 70";break;
}


if ($result = mysqli_query($con, $sql)){
    $resultArray = array();
    $tempArray = array();
    
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    echo json_encode($resultArray);
}

@mysqli_close($result);
@mysqli_close($con);

?>