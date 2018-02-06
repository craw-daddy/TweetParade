<?php
    include_once("/var/www/html/dev/Includes/session.php");
    $project_name =  $_SESSION['project'] ;

  $keyword = $_POST['new_keyword'];
  if(empty($keyword)) 
  {
    echo("You didn't specify a keyword.");
  } 
  else
  {

    require_once('/var/www/html/dev/config.php');
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name);

    
    $test = mysqli_query($con,"SELECT * FROM pid");

    if( ! mysqli_num_rows($test) ) {
      addKeyword($project_name, $con, $keyword);
      header( 'Location: ../Views/Admin/project-keywords.php') ;
    }else{
      stopProcesses($project_name, $test, $con);
      addKeyword($project_name, $con, $keyword);
      startProcess($project_name, $con);
      header( 'Location: ../Views/Admin/project-keywords.php') ;
    }      

  }

   function startProcess($project_name, $con){

    $collector = "/var/www/html/dev/Collector/get_tweets.php ".$project_name;
    $pid = shell_exec('nohup php '.$collector.' > /dev/null & echo $!');

      $query = "INSERT INTO pid (pid) VALUES ('";
      $query = $query.$pid."')";
      echo $query;
     mysqli_query($con,$query);

  }

  function stopProcesses($project_name, $test, $con){

    while($row = mysqli_fetch_array($test)){
       $command = 'kill '.$row['pid'];
       $result = exec($command);
        echo $result;
        $query = "DELETE FROM pid WHERE pid='".$row['pid']."'";
        mysqli_query($con,$query);
      }

  }

  function addKeyword($project_name, $con, $keyword){
  $keyword_test = mysqli_query($con,"SELECT * FROM keywords WHERE phrase = '".$keyword."'");
    if( ! mysqli_num_rows($keyword_test) ) {
      $query = "INSERT INTO keywords (phrase) VALUES ('";
      $query = $query.$keyword."')";
      echo $query;
      mysqli_query($con,$query);
    }else{
      echo "error, keyword exists";
    }
  }
?>
