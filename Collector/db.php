<?php

class db
{
 public $dbh;

    // Create a database connection for use by all functions in this class
  function __construct($project_name) {

    require_once('/var/www/html/tweetParade/config2.php');
    
    if($this->dbh = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name)) { 
            
      // Set every possible option to utf-8
      mysqli_query($this->dbh, 'SET NAMES "utf8mb4"');
      mysqli_query($this->dbh, 'SET CHARACTER SET "utf8mb4"');
    } else {
     echo 'DB CONNECTION ERROR!!!!';
    }
        
    date_default_timezone_set(TIME_ZONE);
  }

  // Update geo table
  public function replaceIntoGeo($values) {
    $query = "REPLACE INTO geo (ID, type, longitude, latitude, place_id, place_url, place_type, place_name, place_full_name, place_country_code, place_country, tweet_id) VALUES (".$values.")";
    //error_log($query."\n", 3, "/var/tmp/geo-errors4.log");
    echo("\r\n");
    echo $query;
    echo("\r\n");
    mysqli_query($this->dbh,$query);
  }

  // Update hashtags table
  public function replaceIntoHashtags($values) {
    $query = "REPLACE INTO hashtags (tweet_id, text, start, end) VALUES (".$values.")";
    echo("\r\n");
    echo $query;
    echo("\r\n");
    mysqli_query($this->dbh,$query);
  }

  // Update urls table
  public function replaceIntoURLs($values) {
    $query = "REPLACE INTO urls (ID, tweet_id, url, display_url, expanded_url, start, end) VALUES (".$values.")";
    echo("\r\n");
    echo $query;
    echo("\r\n");
    mysqli_query($this->dbh,$query);
  }

  // Update mentions table
  public function replaceIntoMentions($values) {
    $query = "REPLACE INTO mentions (tweet_id, screen_name, name, user_id) VALUES (".$values.")";
    echo("\r\n");
    echo $query;
    echo("\r\n");
    mysqli_query($this->dbh,$query);
  }

  // Update users table
  public function replaceIntoUsers($values) {
    $query = "REPLACE INTO users (id, name, screen_name, followers_count, friends_count, tweet_count, geo_enabled, created_at, profile_image_url) VALUES (".$values.")";
    echo("\r\n");
    echo $query;
    echo("\r\n");
    mysqli_query($this->dbh,$query);
    echo "USERS:  MySQL error:   ".mysqli_error($this->dbh)."\n\n";
    // error_log("\r\n".$query, 3, "/var/tmp/my-errors.log");

  }

    // Update tweets table
  public function replaceIntoTweets($tweet_id, $user_id, $tweet_text, $created_at, $retweet_count, $favorite_count, $media_url, $screen_name) {

  	$blackListTest = 0;
  	$whiteListTest = 0;

      $query = "SELECT * FROM blacklist";
      $result = mysqli_query($this->dbh,$query);

    $blackListedArray = array();

      while($row = mysqli_fetch_array($result)){
         $blackListedArray[] = $row['screen_name'];
      }

      $query = "SELECT * FROM whitelist";
      $result = mysqli_query($this->dbh,$query);

    $whiteListedArray = array();

      while($row = mysqli_fetch_array($result)){
         $whiteListedArray[] = $row['screen_name'];
      }

    if( !empty( $blackListedArray ) )
    {
      foreach ($blackListedArray as $user) {
        if(strcmp($screen_name, $user) === 0){
          $blackListTest = 1;
        }
      }
    }

    if( !empty( $whiteListedArray ) ) {
    	foreach ($whiteListedArray as $user) {
    		if(strcmp($screen_name, $user) === 0){
    			$whiteListTest = 1;
    		}
      }
    }

  	if($whiteListTest == 1){

  		$tweet_values = $tweet_id.', '.$user_id.', '.'"'.mysqli_real_escape_string($this-dbh,$tweet_text) . '", '.strtotime($created_at).', '.$retweet_count.', '.$favorite_count.', '.'"'.$media_url.'", '.'1, '.'1, '.'5000, '.'0, '.'0,0,0' ;

  	}else if($blackListTest == 1){

   		$tweet_values = $tweet_id.', '.$user_id.', '.'"'.$tweet_text . '", '.strtotime($created_at).', '.$retweet_count.', '.$favorite_count.', '.'"'.$media_url.'", '.'1, '.'0, '.'5000, '.'0, '.'0,0,0' ;

  	}else{

   		$tweet_values = $tweet_id.', '.$user_id.', '.'"'.$tweet_text . '", '.strtotime($created_at).', '.$retweet_count.', '.$favorite_count.', '.'"'.$media_url.'", '.'0, '.'0, '.'5000, '.'0, '.'0,0,0' ;

  	}

  	$query = "REPLACE INTO tweets (id, user_id, text, created_at, retweet_count, favorite_count, media_url, reviewed, approved, display_time, display_count, pinned, profile_img_censored, media_img_censored) VALUES (".$tweet_values.")";
  	echo("\r\n");
  	echo $query;
  	echo("\r\n");
  	mysqli_query($this->dbh,$query);
        echo ("\n\nMySQL error:   ".mysqli_error($this->dbh)."\n\n");

  }
}
?>
