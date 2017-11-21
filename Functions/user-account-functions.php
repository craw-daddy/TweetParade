<?php
   
function generate_salt($length) {
    //md5 returns 32 characters
    $unique_random_string = md5(uniqid(mt_rand(), true));

    //valid characters for a salt are [a-zA-Z0-9./]
    $base64_string = base64_encode($unique_random_string);

    $modified_base64_string = str_replace('+', '.', $base64_string);

    $salt = substr($modified_base64_string, 0, $length);

    return $salt;
}

function password_encrypt($password) {
    //blowfish hash
    $hash_format = "$2y$10$";
    $salt_length = 22;
    $salt = generate_salt($salt_length);

    $format_and_salt = $hash_format.$salt;
    $hash = crypt($password, $format_and_salt);

    return $hash;
}

function password_check($password, $existing_hash) { 
    //existing hash contains format and salt at start
    $hash = crypt($password, $existing_hash);
    if($hash === $existing_hash) {
        return true;
    }
    else {
        return false;
    }
}

function attempt_login($username, $password) {

//    ChromePhp::log("Attempt Login::");

    $user = find_user_by_username($username);

//    ChromePhp::log("User: ".$user);

    if($user) {
        //found user, check password
        if(password_check($password, $user["hashed_password"])){
            //password matchs 
            return $user;
        }
        else {
            return false;
        }
    }
    else {
        //admin not found
        return false;
    }

}

function find_user_by_username($username) {

//    ChromePhp::log("Finding User.. " .$username);
    // Create connection
    $mysqli = new mysqli('10.30.0.110', 'tgorry','Lambo1988', 'tweetparade_administrators');
//    ChromePhp::log("Creating connection.. ");
    // Check connection
    if ($mysqli->connect_errno) {
//       ChromePhp::log("Connection error! " );
       echo "Failed to connect to MySQL [Test]: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
//    ChromePhp::log("Connected! " );

    $safe_username = mysqli_real_escape_string($mysqli, $username);

//    ChromePhp::log("Making user safe.. " . $safe_username);

    $query = "SELECT * ";
    $query .= "FROM administrators ";
    $query .= "WHERE username = '{$username}' ";
    $query .= "LIMIT 1";

    $user_set = mysqli_query($mysqli, $query);

    //confirm_query($user_set);

    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    }
    else {
        return null;
    }
    
}

?>
