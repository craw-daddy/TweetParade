<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$project_name = $argv[1];


// Collect tweets from the Twitter streaming API

require_once('/var/www/html/tweetParade/config2.php');

require_once('libraries/phirehose/Phirehose.php');
require_once('libraries/phirehose/OauthPhirehose.php');
class Consumer extends OauthPhirehose
{   

  // A database connection is established at launch and kept open permanently
  public $oDB;
  public function db_connect($project_name) {
    require_once('db.php');
    $this->oDB = new db($project_name);

  }

  // This function is called automatically by the Phirehose class
  // when a new tweet is received with the JSON data in $status
  public function enqueueStatus($status) {

    // error_log("Incoming tweet.. \n", 3, "/var/tmp/geo-coordinates6.log");


    $tweet_object = json_decode($status);

    // error_log(print_r($tweet_object,true), 3, "/var/tmp/object2.log");
        
    // Ignore tweets without a properly formed tweet id value
    if (!(isset($tweet_object->id_str))) { return;}
        

    $tweet_id = $tweet_object->id_str;
    $tweet_text = $tweet_object->text;
    $created_at = $tweet_object->created_at;
    $media_url = NULL;
    $entities_object = $tweet_object->entities;

    if(array_key_exists('media', $entities_object)){
        $media_object = $entities_object->media;
        foreach($media_object as $media_unit){
            $media_url = $media_unit->media_url;
        }
    }    

    $user_object = $tweet_object->user;
    $user_id = $user_object->id_str;
    $screen_name = $user_object->screen_name;
    $name = $user_object->name;
    $followers = $user_object->followers_count;
    $friends = $user_object->friends_count;
    $tweet_count = $user_object->statuses_count;
    $profile_image_url = implode("", explode("_normal", $user_object->profile_image_url));
    $user_created_at = $user_object->created_at;
    
    //THIS DOESN'T WORK - EMPTY VALUE. BREAKS QUERY AND SHOULD BE FIXED.
    $geo_enabled = $user_object->geo_enabled;

    if(is_null($geo_enabled)) {
		$geo_enabled = 0;
	}
    if (!isset($geo_enabled)) {
        $geo_enabled = 0;
    }
    if(empty($geo_enabled)) {
        $geo_enabled = 0;    
    }


    $user_values = $user_id.', '.
        '"'.$name.'", '.
        '"'.$screen_name.'", ' .
        $followers.', ' .
        $friends.', '.
        $tweet_count.', '.
        $geo_enabled.', '.
        strtotime($user_created_at).', ' .
        '"'.$profile_image_url.'"';

    //error_log($user_values."\n", 3, "/var/tmp/geo-coordinates6.log");
    $this->oDB->replaceIntoUsers($user_values);
    $this->oDB->replaceIntoTweets($tweet_id, $user_id, $tweet_text, $created_at, $media_url, $screen_name);

    if(array_key_exists('user_mentions', $entities_object)){
        $mentions_object = $entities_object->user_mentions;
        foreach($mentions_object as $mentions_unit){
            $screen_name = $mentions_unit->screen_name;
            $name = $mentions_unit->name;
            $user_id = $mentions_unit->id_str;

            $mention_values = $tweet_id.', '.
            '"'.$screen_name.'", '.
            '"'.$name.'", ' .
            $user_id;

            //error_log($mention_values."\n", 3, "/var/tmp/geo-coordinates6.log");
            $this->oDB->replaceIntoMentions($mention_values);

        }
    }

    if(array_key_exists('hashtags', $entities_object)){
        $hashtags_object = $entities_object->hashtags;
        foreach($hashtags_object as $hashtags_unit){
            $text = $hashtags_unit->text;
            $indices = $hashtags_unit->indices;
            $start = $indices[0];
            $end = $indices[1];

            $hashtag_values = $tweet_id.', '.
            '"'.$text.'", '.
            $start.', '.
            $end;

            //error_log($hashtag_values."\n", 3, "/var/tmp/geo-coordinates6.log");
            $this->oDB->replaceIntoHashtags($hashtag_values);

        }
    }

   if (array_key_exists('urls', $entities_object)){
        $urls_object = $entities_object->urls;
        foreach($urls_object as $url_unit){
            $url = $url_unit->url;
            $display_url = $url_unit->display_url;
            $expanded_url = $url_unit->expanded_url;
            $indices = $url_unit->indices;
            $start = $indices[0];
            $end = $indices[1];

            $urls_values = 'NULL, '.
                $tweet_id.', '.
                '"'.$url.'", "'.
                $display_url.'", "'.
                $expanded_url.'", '.
                $start.', '.
                $end;
        
            if ($display_url)
               {  $this->oDB->replaceIntoUrls($urls_values);  }
        }
   }
    
    //if(array_key_exists('coordinates', $tweet_object) {
    //         error_log("coordinates attached \n", 3, "/var/tmp/geo-coordinates3.log");
    //}

    if($geo_enabled && ( ($tweet_object->place !== null) || ($tweet_object->coordinates !== null) ) ){
        $coordinates_object = $tweet_object->coordinates;

        $coordinates = $coordinates_object->coordinates;
        $place_object = $tweet_object->place;
        
        $type = $coordinates_object->type;
        $longtitude = $coordinates[0];
        $latitude = $coordinates[1];

        if(empty($longtitude)) $longtitude = 0;
        if(empty($latitude)) $latitude = 0;

        $place_id = $place_object->id;
        $place_url = $place_object->url;
        $place_type = $place_object->place_type;
        $place_name = $place_object->name;
        $place_full_name = $place_object->full_name;
        $place_country_code = $place_object->country_code;
        $place_country = $place_object->country;

        $geo_values = 'NULL'.', '.
            '"'.$type.'", '.
            $longtitude.', '.
            $latitude.', '.
            '"'.$place_id.'", '.
            '"'.$place_url.'", '.
            '"'.$place_type.'", '.
            '"'.$place_name.'", '.
            '"'.$place_full_name.'", '.
            '"'.$place_country_code.'", '.
            '"'.$place_country.'",'.
            $tweet_id;

        //error_log($geo_values."\n", 3, "/var/tmp/geo-coordinates6.log");
        $this->oDB->replaceIntoGeo($geo_values);
    }

  }
}

function getKeywords($project_name){

    $con = mysqli_connect(DB_HOST, 
      DB_USER, DB_PASSWORD, $project_name);

     $query = "SELECT phrase FROM keywords";
    $result = mysqli_query($con,$query);

    $keyword_array = array();

    while($row = mysqli_fetch_array($result)){
       $keyword_array[] = $row['phrase'];
    }
    return $keyword_array;
}

// Open a persistent connection to the Twitter streaming API
$stream = new Consumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);

// Establish a MySQL database connection
$stream->db_connect($project_name);

// The keywords for tweet collection are entered here as an array
// EG: array('recipe','food','cook','restaurant','great meal')
$stream->setTrack(getKeywords($project_name));

// Start collecting tweets
// Automatically call enqueueStatus($status) with each tweet's JSON data
$stream->consume();

?>
