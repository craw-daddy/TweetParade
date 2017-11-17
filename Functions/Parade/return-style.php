<?php 
require '../../config.php';

error_reporting(E_ALL);

$project_name = $_GET['project_name'];

// Create connection
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS, $project_name);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$result = $mysqli->query("SELECT * FROM `styles` where `selected` = 1");


if ($result->num_rows === 0) {
    echo "No such stylesheet";
    exit();
}

echo json_encode($result->fetch_assoc());

// // if ($result->num_rows === 0) {
// //     echo json_encode("No such stylesheet");
// // }

// //$json = $result->fetch_assoc();

//  echo json_encode($result);
?>

