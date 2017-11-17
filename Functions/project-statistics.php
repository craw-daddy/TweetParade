<?php
	            $project_name = $_SESSION['project'];
                
                require ('../../config.php');

                // Create connection
                $mysqli = new mysqli(DB_HOST ,DB_USER,DB_PASS, $project_name);

                // Check connection
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }

                //Tweets
                $total_query = $mysqli->query("SELECT COUNT(*) AS total FROM `tweets` ");
                $pending_query = $mysqli->query("SELECT COUNT(*) AS pending FROM `tweets` WHERE `reviewed` = 0 AND `approved` = 0");
                $denied_query = $mysqli->query("SELECT COUNT(*) AS denied FROM `tweets` WHERE `reviewed` = 1 AND `approved` = 0");
                $approved_query = $mysqli->query("SELECT COUNT(*) AS approved FROM `tweets` WHERE `reviewed` = 1 AND `approved` = 1");

                $total = $total_query->fetch_assoc();
                $pending = $pending_query->fetch_assoc();
                $denied = $denied_query->fetch_assoc();
                $approved = $approved_query->fetch_assoc();

                $_SESSION['total_tweets'] = $total['total'];
                $_SESSION['pending_tweets'] = $pending['pending'];
                $_SESSION['denied_tweets'] = $denied['denied'];
                $_SESSION['approved_tweets'] = $approved['approved'];


                //Users
                $total_user_query = $mysqli->query("SELECT COUNT(*) AS total FROM `users` ");
                $whitelisted_user_query = $mysqli->query("SELECT COUNT(*) AS whitelist FROM `whitelist`");
                $blacklisted_user_query = $mysqli->query("SELECT COUNT(*) AS blacklist FROM `blacklist`");

                $total_users = $total_user_query->fetch_assoc();
                $total_whitelist = $whitelisted_user_query->fetch_assoc();
                $total_blacklist = $blacklisted_user_query->fetch_assoc();

                $_SESSION['total_users'] = $total_users['total'];
                $_SESSION['total_whitelist'] = $total_whitelist['whitelist'];
                $_SESSION['total_blacklist'] = $total_blacklist['blacklist'];

                //keywords
                $total_keywords_query = $mysqli->query("SELECT `phrase` FROM `keywords` ");
                $total_keywords = $total_keywords_query->fetch_assoc();

                $_SESSION['total_keywords'] = $total_keywords;

                $mysqli->close();

?>