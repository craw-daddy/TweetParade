<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Collect tweets from the Twitter streaming API

require_once('../config.php');

require_once('libraries/phirehose/Phirehose.php');
require_once('libraries/phirehose/OauthPhirehose.php');
class Consumer extends OauthPhirehose
{   

  // This function is called automatically by the Phirehose class
  // when a new tweet is received with the JSON data in $status
  public function enqueueStatus($status) {
    $tweet_object = json_decode($status);
        
    // Ignore tweets without a properly formed tweet id value
    if (!(isset($tweet_object->id_str))) { return;}
    if(isset($tweet_object->coordinates)){
        $tweet_id = $tweet_object->id_str;
        $coordinates_object = $tweet_object->coordinates;
        $coordinates = $coordinates_object->coordinates;
        $place_object = $tweet_object->place;
        
        $type = $coordinates_object->type;
        $longtitude = $coordinates[0];
        $latitude = $coordinates[1];
        $place_id = $place_object->id;
        $place_url = $place_object->url;
        $place_type = $place_object->place_type;
        $place_name = $place_object->name;
        $place_full_name = $place_object->full_name;
        $place_country_code = $place_object->country_code;
        $place_country = $place_object->country;

        $geo_values = $tweet_id.', '.
            '"'.$type.'", '.
            $longtitude.', '.
            $latitude.', '.
            '"'.$place_id.'", '.
            '"'.$place_url.'", '.
            '"'.$place_type.'", '.
            '"'.$place_name.'", '.
            '"'.$place_full_name.'", '.
            '"'.$place_country_code.'", '.
            '"'.$place_country.'"';

        echo $geo_values;

    //echo "<pre>";
    //print_r ($tweet_object);
    //echo "</pre>";
        exit(0);
    }
    //echo "<pre>";
    //print_r ($tweet_object);
    //echo "</pre>";
    

  }
}

function getKeywords(){

    $keyword_array = array('morning');
    return $keyword_array;
}

// Open a persistent connection to the Twitter streaming API
$stream = new Consumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);

// The keywords for tweet collection are entered here as an array
// EG: array('recipe','food','cook','restaurant','great meal')
$stream->setTrack(getKeywords());

// Start collecting tweets
// Automatically call enqueueStatus($status) with each tweet's JSON data
$stream->consume();

?>