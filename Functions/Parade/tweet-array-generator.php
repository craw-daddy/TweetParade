<?php
    error_reporting(0);
    require '../../config.php';

    
    $project_name = $_GET['project_name'];
    // Create connection
    $mysqli = new mysqli(DB_HOST ,DB_USER,DB_PASS, $project_name);

    //The saviour of the ghost tweet bug.
    $mysqli->set_charset("utf8");
    // Check connection
    if ($mysqli->connect_errno) {
       echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    //This can now be more elaborate, based on time (priority), pinned etc - determine frequency of tweets.
    $result = $mysqli->query("SELECT * FROM `tweets` WHERE `reviewed` = 1 AND `approved` = 1");
    $count = $mysqli->query("SELECT COUNT(1) FROM `tweets` WHERE `reviewed` = 1 AND `approved` = 1");

    while($r = $result->fetch_assoc()) {
        // $rows[] = $r;

        $user_query = $mysqli->query("SELECT * FROM `users` WHERE `id` = ".$r['user_id']);
        $user_result = $user_query->fetch_assoc();

        foreach ($user_result as $key => $value) {
            $r[$key] = $value; 
        }
        
        $rows[] = $r;

    }
    // Get the images from twitter, resize and save to server - the resized images will then load from the sever.
    // $media_image = $rows['profile_image_url'];


    // $resized = $media_image->resize(150, 150);
    // $resized->saveToFile($rows['profile_image_url']."_resized.jpg");

    // $rows['profile_image_url'] = "wide_image/lib/WideImage.php".$rows['profile_image_url']."_resized.jpg";


    echo json_encode($rows);


?>