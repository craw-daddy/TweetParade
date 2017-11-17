<?php
                require ('/var/www/html/tweetParade/config.php');
                $project_name = $_GET['project_name'];

                // Create connection
                $mysqli = new mysqli(DB_HOST ,DB_USER,DB_PASS, $project_name);

                // Check connection
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                                //Tweets
                $pending_query = $mysqli->query("SELECT COUNT(*) AS pending FROM `tweets` WHERE `reviewed` = 0 AND `approved` = 0");

                //Collector Status#

                $query = "SELECT * FROM pid";
                $result = mysqli_query($mysqli, $query);
                $count = 0;

                while($row = mysqli_fetch_array($result)){
                    $count++;
                }

                if($count == 1) $_SESSION['collector_status'] = "Collecting";
                else $_SESSION['collector_status'] = "Not Collecting";


                $mysqli->close(); 

                $pending = $pending_query->fetch_assoc();

                //$_SESSION['pending_tweets'] = $pending['pending'];

                echo $pending['pending'];
?>
