	<?php
     
	 function getCollectorStatus($project_name){

		require_once('../../config.php');
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name);
		if (mysqli_connect_errno()) {
			header( 'Location: no_existing_project.php?project_name='.$project_name ) ;
		}
						 
		$query = "SELECT * FROM pid";
		$result = mysqli_query($con,$query);
		$count = 0;

		while($row = mysqli_fetch_array($result)){
			$count++;
		}

		return $count;

	 }

	?>