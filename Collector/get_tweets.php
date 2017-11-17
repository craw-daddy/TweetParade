<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$project_name = $argv[1];


// Collect tweets from the Twitter streaming API

require_once('../config.php');

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
    $tweet_object = json_decode($status);
        
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

    $user_values = $user_id.', '.
        '"'.$name.'", '.
        '"'.$screen_name.'", ' .
        $followers.', ' .
        $friends.', '.
        $tweet_count.','.
        strtotime($user_created_at).', ' .
        '"'.$profile_image_url.'"';

    $this->oDB->replaceIntoUsers($user_values);
    $this->oDB->replaceIntoTweets($tweet_id, $user_id, $tweet_text, $created_at, $media_url, $screen_name);

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