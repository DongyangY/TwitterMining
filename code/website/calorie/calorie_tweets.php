<html>
<head>
<title>Twitter Rest Test</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php

include_once('twitteroauth/twitteroauth.php');

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
mysqli_query($con,"DELETE FROM calorie_tweets");

define('API_KEY', 'N52DOuXGSqJvPDAhqclJtlAli');
define('API_SECRET', 'VoReVCHdfx5Nmfzdf5GJQe9F8Sa5d7MAiZIQNc0MGd8gxnUc8l');
define('ACCESSTOKEN', '2796206664-VgDlTzBQYMhcCuO4zFBlS5HNsfEEwCwmBOKLzvN');
define('ACCESSTOKEN_SECRET', 'yxD1zKrZSnFjpO0pEtxczKIeBPRrGQCbrkNkVgpIMIWNk');

$twitter = new TwitterOAuth(API_KEY, API_SECRET, ACCESSTOKEN, ACCESSTOKEN_SECRET);

$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=ran+mins&result_type=recent&count=1000&lang=en');

echo "Keyword: ran+mins"."<br>"."<br>";

foreach($tweets as $v1){
    foreach($v1 as $v2){
        if($v2->text){
            echo "<img src=".$v2->user->profile_image_url.">"."<br>"."Screen name: ".$v2->user->screen_name."     "."Created at: ".$v2->created_at."<br>";
            echo "Tweet: ".$v2->text."<br>"."<br>";
            $sql = "INSERT INTO calorie_tweets(profile_image_url, screen_name, tweet_text, created_at) Values ('".$v2->user->profile_image_url."','".$v2->user->screen_name."','".$v2->text."','".$v2->created_at."')";
            mysqli_query($con,$sql);
        }
    }
}

$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=rode+mins&result_type=recent&count=1000&lang=en');

echo "Keyword: rode+mins"."<br>"."<br>";

foreach($tweets as $v1){
    foreach($v1 as $v2){
        if($v2->text){
            echo "<img src=".$v2->user->profile_image_url.">"."<br>"."Screen name: ".$v2->user->screen_name."     "."Created at: ".$v2->created_at."<br>";
            echo "Tweet: ".$v2->text."<br>"."<br>";
            $sql = "INSERT INTO calorie_tweets(profile_image_url, screen_name, tweet_text, created_at) Values ('".$v2->user->profile_image_url."','".$v2->user->screen_name."','".$v2->text."','".$v2->created_at."')";
            mysqli_query($con,$sql);
        }
    }
}

$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=swam+mins&result_type=recent&count=1000&lang=en');

echo "Keyword: swam+mins"."<br>"."<br>";

foreach($tweets as $v1){
    foreach($v1 as $v2){
        if($v2->text){
            echo "<img src=".$v2->user->profile_image_url.">"."<br>"."Screen name: ".$v2->user->screen_name."     "."Created at: ".$v2->created_at."<br>";
            echo "Tweet: ".$v2->text."<br>"."<br>";
            $sql = "INSERT INTO calorie_tweets(profile_image_url, screen_name, tweet_text, created_at) Values ('".$v2->user->profile_image_url."','".$v2->user->screen_name."','".$v2->text."','".$v2->created_at."')";
            mysqli_query($con,$sql);
        }
    }
}

$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=played+basketball+mins&result_type=recent&count=1000&lang=en');

echo "Keyword: played+basketball+mins"."<br>"."<br>";

foreach($tweets as $v1){
    foreach($v1 as $v2){
        if($v2->text){
            echo "<img src=".$v2->user->profile_image_url.">"."<br>"."Screen name: ".$v2->user->screen_name."     "."Created at: ".$v2->created_at."<br>";
            echo "Tweet: ".$v2->text."<br>"."<br>";
            $sql = "INSERT INTO calorie_tweets(profile_image_url, screen_name, tweet_text, created_at) Values ('".$v2->user->profile_image_url."','".$v2->user->screen_name."','".$v2->text."','".$v2->created_at."')";
            mysqli_query($con,$sql);
        }
    }
}

$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=played+football+mins&result_type=recent&count=1000&lang=en');

echo "Keyword: played+football+mins"."<br>"."<br>";

foreach($tweets as $v1){
    foreach($v1 as $v2){
        if($v2->text){
            echo "<img src=".$v2->user->profile_image_url.">"."<br>"."Screen name: ".$v2->user->screen_name."     "."Created at: ".$v2->created_at."<br>";
            echo "Tweet: ".$v2->text."<br>"."<br>";
            $sql = "INSERT INTO calorie_tweets(profile_image_url, screen_name, tweet_text, created_at) Values ('".$v2->user->profile_image_url."','".$v2->user->screen_name."','".$v2->text."','".$v2->created_at."')";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($con);
?>

</body>
</html>