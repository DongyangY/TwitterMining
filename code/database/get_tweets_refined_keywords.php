<?php

require_once('140dev_config.php');
require_once('phirehose/Phirehose.php');
require_once('phirehose/OauthPhirehose.php');

class Consumer extends OauthPhirehose
{
  // A database connection is established at launch and kept open permanently
  public $oDB;
  public function db_connect() {
    require_once('db_lib.php');
    $this->oDB = new db;
  }
	
  // This function is called automatically by the Phirehose class
  // when a new tweet is received with the JSON data in $status
  public function enqueueStatus($status) {
    $display = json_decode($status,true);
    print_r($display);

    $tweet_object = json_decode($status);
    $tweet_id = $tweet_object->id_str;

    // If there's a ", ', :, or ; in object elements, serialize() gets corrupted 
    // You should also use base64_encode() before saving this
    $raw_tweet = base64_encode(serialize($tweet_object));
		
    $field_values = 'raw_tweet = "' . $raw_tweet . '", ' .
      'tweet_id = ' . $tweet_id;
    $this->oDB->insert('json_cache',$field_values);
  }
}

// Open a persistent connection to the Twitter streaming API
$stream = new Consumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);



// Establish a MySQL database connection
$stream->db_connect();

  // $stream->setLocations(array(
   //      array(-122.75, 36.8, -121.75, 37.8), // San Francisco
   //      array(-74, 40, -73, 41),             // New York
    // ));

// The keywords for tweet collection are entered here as an array
// More keywords can be added as array elements
// For example: array('recipe','food','cook','restaurant','great meal')
$stream->setTrack(array('walked calories', 'walked meters', 'walked miles', 'walked mins', 'ran calories', 'ran meters', 'ran miles', 'ran mins', 'rode calories', 'rode miles', 'rode meters', 'rode mins', 'swam calories', 'swam miles', 'swam meters', 'swam yards', 'swam mins', 'played basketball mins', 'played football mins'));



// Start collecting tweets
// Automatically call enqueueStatus($status) with each tweet's JSON data
$stream->consume();

?>