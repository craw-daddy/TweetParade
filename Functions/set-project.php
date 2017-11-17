<?php
    include_once("../Includes/session.php");
    $project_name = $_REQUEST['project_name'] ;
    $_SESSION['project'] = $project_name;
    header( 'Location: ../Views/Admin/project-home.php') ;
?>
