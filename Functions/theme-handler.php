<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header("Location: ../../Views/User/index.php");
  }

  $selected_theme = $_POST['layout'];
  $project_name = $_SESSION['project'];

  if(isset($_POST['select'])) {
    selectNewStyle($project_name, $selected_theme);
    header( 'Location: ../Views/Admin/manage-style.php');
  }

  if(isset($_POST['delete'])) {
    deleteStyle($project_name, $selected_theme);
    header( 'Location: ../Views/Admin/manage-style.php');
  }

  if(isset($_POST['new'])) {
     header( 'Location: ../Views/Admin/create-new-style.php') ;
  }

  if(isset($_POST['edit'])) {
     header( 'Location: ../Views/Admin/edit-style.php?style='.$selected_theme);
  }

  if(isset($_POST['preview'])) {
     header( 'Location: ../../controlPanel/live_style_update/live_tweet_wall_style.php?project_name='.$project_name);
  }

  function deleteStyle($project_name, $selected_theme){

    require_once('../config.php');
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $project_name);

    if (mysqli_connect_errno()) {
      header( 'Location: no_existing_project.php?project_name='.$project_name ) ;
    }

    $query = "DELETE FROM styles WHERE layout='".$selected_theme."'";
    $mysqli->query($query);

    if (!$mysqli->query($query)) {
    printf("Errormessage: %s\n", $mysqli->error);
    }

    mysqli_close($mysqli);

  }

  function selectNewStyle($project_name, $selected_theme){

    require_once('../config.php');
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $project_name);

    if (mysqli_connect_errno()) {
      header( 'Location: no_existing_project.php?project_name='.$project_name );
    }

    $query = "UPDATE styles SET selected=0 WHERE selected=1";
    $mysqli->query($query);

    $query = "UPDATE styles SET selected=1 WHERE layout='".$selected_theme."'";
    $mysqli->query($query);

    mysqli_close($mysqli);

  }

?>