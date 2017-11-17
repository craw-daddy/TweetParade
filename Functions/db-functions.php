<?php
    include_once("/var/www/html/tweetParade/config.php");
    $mysqli = new mysqli('10.30.0.110', 'tgorry','Lambo1988', 'tweetparade_administrators');
    //$mysqli = new mysqli('213.171.218.234', 'tweetparade', '!76trombones', "tweetparade");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
?>
