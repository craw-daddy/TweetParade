<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once("/var/www/html/dev/Includes/session.php");
    $project_name =  $_SESSION['project'];


  if(isset($_POST['start'])) {

  	start($project_name);

  }
  if(isset($_POST['stop'])) {

  	stop($project_name);

  }

  function start($project_name){

  	require_once('/var/www/html/dev/config2.php');
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name);
    $test = mysqli_query($con,"SELECT * FROM pid");
    $collector = "/var/www/html/dev/Collector/get_tweets.php ".$project_name;

    if( ! mysqli_num_rows($test) ) {

	  	$pid = shell_exec('nohup php '.$collector.' > /dev/null & echo $!');

		  $query = "INSERT INTO pid (pid) VALUES ('";
	    $query = $query.$pid."')";
	    echo $query;
	   mysqli_query($con,$query);
     header( 'Location: ../Views/Admin/manage-collector.php' ) ;
     //echo $pid;

    }else{
    	while($row = mysqli_fetch_array($test)){
			 stop($project_name, $row['pid']);
		  }

    	$start = $_POST['start'];
		  $pid = shell_exec('nohup php '.$collector.' > /dev/null & echo $!');
	  	//echo $pid;

		  $query = "INSERT INTO pid (pid) VALUES ('";
	    $query = $query.$pid."')";
	    echo $query;
	    mysqli_query($con,$query);
      header( 'Location: ../Views/Admin/manage-collector.php' ) ;
      //echo $pid;
      $_SESSION['collector'] = "collecting";
    }    

  }

  function stop($project_name, $pid = 0){

      require_once('/var/www/html/dev/config.php');
      $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name);
      
  	if($pid == 0){

    	$test = mysqli_query($con,"SELECT * FROM pid");

    	while($row = mysqli_fetch_array($test)){
			 $command = 'kill '.$row['pid'];
    	 $result = exec($command);
        echo $result;
    		$query = "DELETE FROM pid WHERE pid='".$row['pid']."'";
      	mysqli_query($con,$query);
		  }

      header( 'Location: ../Views/Admin/manage-collector.php' ) ;

  	}else{
		$command = 'kill '.$pid;
    	exec($command);
    	$query = "DELETE FROM pid WHERE pid='".$pid."'";
      mysqli_query($con,$query);
  	}

  }

?>
