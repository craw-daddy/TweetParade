<?php
error_reporting(-1);
echo $_REQUEST['project_name'] ;
include_once("../Includes/session.php");
$project_name = $_REQUEST['project_name'] ;

if($project_name){

	require_once('../config2.php');

	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);



	// Check connection
	// if ($con->connect_errno)
	//   {
	//   echo "Failed to connect to MySQL: " . $con->connect_errno;
	//   }

	// Create database
	$sql="CREATE DATABASE tweetparade_".$project_name ." CHARACTER SET utf8mb4";
	echo "SQL Query Created.";

	if ($con->query($sql))
	  {
	  echo "Database tweetparade_".$project_name." created successfully";
	  createTables($project_name);
      $_SESSION['project'] = "tweetparade_".$project_name;
	  header( 'Location: ../Views/Admin/project-home.php') ;
	  }
	else
	  {
	  echo "Error creating database: " . mysqli_error($con);
	  if(mysqli_error($con) == 'Can\'t create database \'test_1\'; database exists'){
          $_SESSION['existing_project'] = $project_name;
	  	header( 'Location: ../database_exists.php' ) ;
	  }
	  }

}
else{
	echo "ERROR! - Click back in your browser and try again.";
}


function createTables($project_name) {
    echo "creating tables";
		$con= new mysqli(DB_HOST,DB_USER,DB_PASSWORD,"tweetparade_".$project_name);
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }

		// Create keywords table
		$sql="CREATE TABLE keywords(ID int(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),phrase varchar(50) NOT NULL)";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table keywords created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

                // Create tweets table
                $sql="CREATE TABLE tweets(id bigint(30) NOT NULL , PRIMARY KEY(id),user_id bigint(30) NOT NULL, text varchar(300) NOT NULL, created_at int(30) NOT NULL, retweet_count int (12), favorite_count int (12), media_url varchar(1024), reviewed tinyint(1) NOT NULL, approved_at int(30), approved tinyint(1) NOT NULL, display_time int(6), display_count int(11), pinned tinyint(1) NOT NULL, profile_img_censored tinyint(1) NOT NULL, media_img_censored tinyint(1) NOT NULL)";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table tweets created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

		// Create hashtags table
		$sql="CREATE TABLE hashtags(ID int(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),tweet_id bigint(30) NOT NULL, text varchar(128) NOT NULL, start int(11) NOT NULL, end int(11) NOT NULL)";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table hashtags created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

		// Create mentions table
		$sql="CREATE TABLE mentions(ID int(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),tweet_id bigint(30) NOT NULL, screen_name varchar(50) NOT NULL, name varchar(50) NOT NULL, user_id bigint(30) NOT NULL)";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table mentions created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

		// Create geo table
		$sql="CREATE TABLE geo(ID int(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),type varchar(128) NOT NULL, longitude float(10,10) NOT NULL, latitude float(10,10) NOT NULL, place_id varchar(128) NOT NULL, place_url varchar(512) NOT NULL, place_type varchar(128) NOT NULL, place_name varchar(256) NOT NULL, place_full_name varchar(256) NOT NULL, place_country_code varchar(128) NOT NULL, place_country varchar(128) NOT NULL, tweet_id bigint(30) NOT NULL)";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table geo created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

		// Create users table
		$sql="CREATE TABLE users(id bigint(30) NOT NULL , PRIMARY KEY(id),name varchar(50) NOT NULL, screen_name varchar(50) NOT NULL, followers_count int(10) NOT NULL, friends_count int(10) NOT NULL, tweet_count int(10) NOT NULL, geo_enabled int(2) NOT NULL, created_at int(10) NOT NULL, profile_image_url varchar(1024))";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table users created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

		// Create pid table
		$sql="CREATE TABLE pid(pid int(11))";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table pid created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

		// Create style table
		$sql="CREATE TABLE styles(ID int(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID), event_name varchar(60), event_hash_tag varchar(60), event_logo varchar(120), event_sponsors varchar(2048), font_family varchar(120), h1_font_colour varchar(120), h2_font_colour varchar(120), h3_font_colour varchar(120), h4_font_colour varchar(120), font_shadow_colour varchar(120), heading_colour varchar(120), translucent_background_colour varchar(120), translucent_background_opacity varchar(120), tweet_bar_colour varchar(120), image_border_colour varchar(120), twitter_logo_selection tinyint(1), layout varchar(60), background varchar(120), link_colour varchar(120), hash_colour varchar(120), mention_colour varchar(120), show_header tinyint(1), show_footer tinyint(1), selected tinyint(1))";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table styles created successfully";

		 	$sql = "INSERT into styles (event_name, event_logo, event_sponsors, font_family, h1_font_colour, h2_font_colour, h3_font_colour, h4_font_colour, font_shadow_colour, heading_colour, translucent_background_colour, translucent_background_opacity, tweet_bar_colour, image_border_colour, twitter_logo_selection, layout, background, link_colour, hash_colour, mention_colour, show_header, show_footer, selected) values
		 	('tweetparade_".$project_name."', '../images/uploads/default_logo.png', '../../images/default/sponsors/Default Layout/msp-logo.png;../../images/default/sponsors/Default Layout/nest_logo.png;../../images/default/sponsors/Default Layout/uol.png;', 'Hammersmith One', 'ffffff', 'ffffff', 'ffffff', 'ffffff', 'ffffff', '2c3e50', '292F33', '50', '0AF', 'fff', '0', 'Default Layout', '../images/uploads/default_bg.jpg', '4fccf2', '4fccf2', '4fccf2', 1, 1, 1)";
			if ($con->query($sql))
			{
				echo "Table styles populated successfully";
			}
			else
			{
				echo "Error populating table: " . mysqli_error($con);
			}
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

		// Create whitelist table
		$sql="CREATE TABLE whitelist(screen_name varchar(60))";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table whitelist created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }


		// Create blacklist table
		$sql="CREATE TABLE blacklist(screen_name varchar(60))";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table blacklist created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

                //  Create urls table
                $sql = "CREATE TABLE urls (ID int(15) NOT NULL AUTO_INCREMENT, tweet_id bigint(30), url varchar(140), display_url varchar(140), expanded_url varchar(350), start INT(11), end INT(11), PRIMARY KEY(ID))";

		// Execute query
		if ($con->query($sql))
		  {
		  echo "Table urls created successfully";
		  }
		else
		  {
		  echo "Error creating table: " . mysqli_error($con);
		  }

	}

?>
