<?php
/**
 * Unit testing for demography.php
 */


$sample_users = array (
    "user_1" => array("screen_name" => "TomCruise", "name" => "Tom Cruise", 
    	"description" => "Actor. Producer. Running in movies since 1981.",
    	"actural_gender" => "male", "actural_age" => "52"),
    "user_2" => array("screen_name" => "ladygaga", "name" => "Lady Gaga", 
    	"description" => "The lady herself is not just a chameleon in person, but a chameleon in music.",
    	"actural_gender" => "female", "actural_age" => "28"),
    "user_3" => array("screen_name" => "DwightHoward", "name" => "Dwight Howard", 
    	"description" => "No matter how far you fall you are never out of the fight.",
    	"actural_gender" => "male", "actural_age" => "28"),
    "user_4" => array("screen_name" => "kobebryant", "name" => "Kobe Bryant", 
    	"description" => "Dream Epic",
    	"actural_gender" => "male", "actural_age" => "36"),
    "user_5" => array("screen_name" => "JalenRose", "name" => "Jalen Rose", 
    	"description" => "Drum Major for Justice, Peace & Righteousness(MLK). JRLA Founder. ABC/ESPN/Grantland Analyst. Phillipians 4:13.",
    	"actural_gender" => "male", "actural_age" => "41"),
    "user_6" => array("screen_name" => "SarahKSilverman", "name" => "Sarah Silverman", 
    	"description" => "We're all just molecules, Cutie.",
    	"actural_gender" => "female", "actural_age" => "43"),
    "user_7" => array("screen_name" => "PeteCarroll", "name" => "Pete Carroll", 
    	"description" => "Seattle Seahawks head coach. Always Compete. Win Forever.",
    	"actural_gender" => "male", "actural_age" => "63"),
    "user_8" => array("screen_name" => "KevinSpacey", "name" => "Kevin Spacey", 
    	"description" => "Former shoe salesman now making a go at film and theater. Wish me luck...",
    	"actural_gender" => "male", "actural_age" => "55"),
    "user_9" => array("screen_name" => "AliciaKeys", "name" => "Alicia Keys", 
    	"description" => "Passionate about my work, in love with my family and dedicated to spreading light. It's contagious!;-)",
    	"actural_gender" => "female", "actural_age" => "33"),
    "user_10" => array("screen_name" => "Pink", "name" => "P!nk", 
    	"description" => "it's all happening",
    	"actural_gender" => "female", "actural_age" => "35"),
    "user_11" => array("screen_name" => "brookeburke", "name" => "Brooke Burke-Charvet", 
    	"description" => "Mommy first, wife, host, actress, fitness guru, CEO of @ModernMom, Author of The Naked Mom, co-creator/designer @CAELUM Lifestyle, Foodie, @operationhmchef",
    	"actural_gender" => "female", "actural_age" => "43"),
    "user_12" => array("screen_name" => "mindykaling", "name" => "Mindy Kaling", 
    	"description" => "You can sit with us. Instagram: mindykaling",
    	"actural_gender" => "female", "actural_age" => "35"),
    "user_13" => array("screen_name" => "", "name" => "Nathan Fillion", 
    	"description" => "It costs nothing to say something kind. Even less to shut up altogether.",
    	"actural_gender" => "male", "actural_age" => "43"),
    "user_14" => array("screen_name" => "GordonRamsay", "name" => "Gordon Ramsay", 
    	"description" => "Somewhere always near food.",
    	"actural_gender" => "male", "actural_age" => "48"),
    "user_15" => array("screen_name" => "Ali_Sweeney", "name" => "Alison Sweeney", 
    	"description" => "",
    	"actural_gender" => "female", "actural_age" => "38"),
    "user_16" => array("screen_name" => "ElizabethBanks", "name" => "Elizabeth Banks", 
    	"description" => "Amateur Goofball; proud native, Pittsfield, MA",
    	"actural_gender" => "female", "actural_age" => "40"),
    "user_17" => array("screen_name" => "ninadobrev", "name" => "Nina Dobrev", 
    	"description" => "Where ever you go... there you are. Going day by day... so let's see where it takes me! Namaste.",
    	"actural_gender" => "female", "actural_age" => "25"),
    "user_18" => array("screen_name" => "AudrinaPatridge", "name" => "Audrina Patridge", 
    	"description" => "~~Host of 1stLook!!! Airing after SNL on NBC~~ Instagram-AudrinaPatridge",
    	"actural_gender" => "female", "actural_age" => "29"),
    "user_19" => array("screen_name" => "nerdist", "name" => "Chris Hardwick", 
    	"description" => "Stand-upper, Zombie Therapist, Talking Snake and POINTS giver",
    	"actural_gender" => "male", "actural_age" => "42"),
    "user_20" => array("screen_name" => "elizadushku", "name" => "Eliza Dushku", 
    	"description" => "Official Eliza Dushku. Be forewarned: I'm accused of speaking my own language here... Enjoy",
    	"actural_gender" => "female", "actural_age" => "33"),
    "user_21" => array("screen_name" => "ColinHanks", "name" => "Colin Hanks", 
    	"description" => "music geek/fan of sports/ husband/father/brother/son/ person of interest to few/possibly that guy from that one thing you think is way underrated",
    	"actural_gender" => "male", "actural_age" => "36"),
    "user_22" => array("screen_name" => "paulfeig", "name" => "Paul Feig", 
    	"description" => "Paul is a guy who wears suits and tries not to screw things up. He also created Freaks & Geeks, directed Bridesmaids and The Heat and is currently making Spy.",
    	"actural_gender" => "male", "actural_age" => "52"),
    "user_23" => array("screen_name" => "ShannonElizab", "name" => "Shannon Elizabeth", 
    	"description" => "Co-founder of @ShansenJewelry, actress, director, writer, producer, entrepreneur, vegan, animal activist & philanthropist",
    	"actural_gender" => "female", "actural_age" => "41"),
    "user_24" => array("screen_name" => "katyperry", "name" => "KATY PERRY", 
    	"description" => "CURRENTLY✨BEAMING✨ON THE PRISMATIC WORLD TOUR 2014!",
    	"actural_gender" => "female", "actural_age" => "30"),
    "user_25" => array("screen_name" => "selenagomez", "name" => "Selena Gomez", 
    	"description" => "Get ‘The Heart Wants What It Wants’ and pre-order my new collection ‘For You’ - http://smarturl.it/sga1  Philippians 4:13",
    	"actural_gender" => "female", "actural_age" => "22"),
    "user_26" => array("screen_name" => "BradPaisley", "name" => "Brad Paisley", 
    	"description" => "In 1972, a crack commando unit was sent to prison by a military court for a crime they didn't commit. I was also born.",
    	"actural_gender" => "male", "actural_age" => "42"),
    "user_27" => array("screen_name" => "OzzyOsbourne", "name" => "Ozzy Osbourne", 
    	"description" => "The Prince of Darkness",
    	"actural_gender" => "male", "actural_age" => "65"),
    "user_28" => array("screen_name" => "elissakh", "name" => "Elissa", 
    	"description" => "Lebanese & International singer, 3 times World Music Award! I m in halethob with my new album #halethob",
    	"actural_gender" => "female", "actural_age" => "42"),
    "user_29" => array("screen_name" => "ashleytisdale", "name" => "AshleyTisdaleFrench", 
    	"description" => "My official twitter page!! Hoping my tweets inspire you :)",
    	"actural_gender" => "female", "actural_age" => "29"),
    "user_30" => array("screen_name" => "ashleytisdale", "name" => "Cher", 
    	"description" => "Stand & B Counted or Sit & B Nothing. Don't Litter,Chew Gum,Walk Past Homeless PPL w/out Smile.DOESNT MATTER in 5 yrs IT DOESNT MATTER THERE'S ONLY LOVE&FEAR",
    	"actural_gender" => "female", "actural_age" => "68"),
);

foreach($sample_users as $user){ 
	$gender = getGender($user['screen_name'], $user['name'], $user['description']);
	$age = getAge($user['screen_name'], $user['name'], $user['description']);
	$type = getTp($user['screen_name'], $user['name'], $user['description']);
	echo "<br>NAME: ".$user['name'].
		"<br>DESCRIPTION: ".$user['description'].
		"<br>GENDER_guess: ".$gender.
		"<br>GENDER_actural: ".$user['actural_gender'].
		"<br>AGE_guess: ".$age.
		"<br>AGE_actural: ".$user['actural_age'].
		"<br>TYPE: ".$type."<br>";
} 



//getGender() returns the guessed gender of the user, given the user's ID, screen name and description
function getGender($user, $name, $description) {
	$api = 'http://textalytics.com/core/userdemographics-1.0';
	$key = '0e70ff2a84eab3fda9019ab2202cd91e';
	
	// We make the request and parse the response to an array
	$response = sendPost($api, $key, $user, $name, $description);
	$json = json_decode($response, true);

	$gd = '';
	if(isset($json['gender'])) {
	  if($json['gender'] == 'M')
		$gd = 'MALE';
	  else if($json['gender'] == 'F')
		$gd = 'FEMALE';
	}
	
	return $gd;

}


//getAge() returns the guessed age range of the user, given the user's ID, screen name and description
function getAge($user, $name, $description) {
	$api = 'http://textalytics.com/core/userdemographics-1.0';
	$key = '0e70ff2a84eab3fda9019ab2202cd91e';
	// We make the request and parse the response to an array
	$response = sendPost($api, $key, $user, $name, $description);
	$json = json_decode($response, true);

	$ag = '';
	if(isset($json['age'])) {
	  $ag = $json['age'];
	}
	
	return $ag;
}

//getTp() returns the guessed user type, whether its people or organization, given the user's ID, screen name and description
function getTp($user, $name, $description) {
	$api = 'http://textalytics.com/core/userdemographics-1.0';
	$key = '0e70ff2a84eab3fda9019ab2202cd91e';
	
	// We make the request and parse the response to an array
	$response = sendPost($api, $key, $user, $name, $description);
	$json = json_decode($response, true);
	
	$tp = '';
	if(isset($json['type'])) {
	  if($json['type'] == 'P')
		$tp = 'PERSON';
	  else if($json['type'] == 'O')
		$tp = 'ORGANIZATION';
	}
	
	return $tp;
}


// Auxiliary function to make a post request 
function sendPost($api, $key, $user, $name, $description) {
  $data = http_build_query(array('key'=>$key,
                                 'user'=>$user,
                                 'name'=>$name,
                                 'desc'=>$description,
                                 'src'=>'sdk-php-1.0')); // management internal parameter
  $context = stream_context_create(array('http'=>array(
        'method'=>'POST',
        'header'=>
          'Content-type: application/x-www-form-urlencoded'."\r\n".
          'Content-Length: '.strlen($data)."\r\n",
        'content'=>$data)));
  
  $fd = fopen($api, 'r', false, $context);
  $response = stream_get_contents($fd);
  fclose($fd);
  return $response;
} // sendPost


?>
