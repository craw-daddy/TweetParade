<?php
    include_once("../Includes/session.php");
    $project_name = $_REQUEST['project_name'] ;
    $keywords = $_POST['keywords'];
  if(empty($keywords)) 
  {
    echo("You didn't select any keywords.");
  } 
  else
  {

    require_once('../../config.php');
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name);

    $test = mysqli_query($con,"SELECT * FROM pid");

    if( ! mysqli_num_rows($test) ) {
      removeKeywords($project_name, $con, $keywords);
      header( 'Location: ../Views/Admin/project-keywords.php' ) ;
    }else{
      stopProcesses($project_name, $test, $con);
      removeKeywords($project_name, $con, $keywords);
      startProcess($project_name, $con);
      header( 'Location: ../Views/Admin/project-keywords.php' ) ;
    }
  }

  function startProcess($project_name, $con){

    $collector = "../Collector/get_tweets_new.php ".$project_name;
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

  function removeKeywords($project_name, $con, $keywords){
    $N = count($keywords);
    for($i=0; $i < $N; $i++)
    {
      $query = "DELETE FROM keywords WHERE phrase='".$keywords[$i]."'";
      mysqli_query($con,$query);
      echo $query;
    }
  }
?>
