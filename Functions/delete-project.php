<?php
    include_once("../Includes/session.php");
	$project_name = $_REQUEST['project_name'] ;
    $_SESSION['project'] = NULL;

	if($project_name){

		require_once('../../config.php');
		$con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }else{

			 // Delete database
			echo 'Connected successfully<br />';
			$sql = 'DROP DATABASE '.$project_name;
			$retval = mysqli_query( $con, $sql);
			if(! $retval )
			{
			  die('Could not delete database: ' . mysqli_error());
			}
			echo "Database ".$project_name." deleted successfully\n";
			mysqli_close($con);
            $_SESSION['deleted_project'] = $project_name;
			header( 'Location: ../Views/Admin/project-deleted.php') ;

		  }
	}
	else{
		echo "ERROR! NO PROJECT FOUND - Click back in your browser and try again.";
	}

?>
