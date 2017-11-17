

<?php
    include_once("../../Includes/session.php");
    include_once("../../Includes/header-open.php");
    include_once("../../Includes/header-base-style.php");
    include_once("../../Includes/header-close.php");
?>

<body>

<?php
    include_once("../../Includes/nav-menus.php");

	$project_name = $_SESSION['project'];

                require '../../config.php';

                // Create connection
                $mysqli = new mysqli(DB_HOST ,DB_USER,DB_PASS, $project_name);

                // Check connection
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }

                //for each reviewed tweet
                foreach($_POST["form"] as $form_item) {
                    //default false
                    $profile_image_censored = 0;
                    $media_image_censored = 0;
                    //Check if profile image is censored
                    if(isset($form_item['profile_image'])) {
                        $profile_image_censored = 1;
                    }
                    if(isset($form_item['media_image'])) {
                        $media_image_censored = 1;
                    }
                        
                    if(isset($form_item['review'])) {
                        //if the tweet has been approved 
                        if($form_item['review'] == "approve") {
                            $update = $mysqli->query("UPDATE `tweets` SET `approved` = 1, `reviewed` = 1, `approved_at` = '".time()."' WHERE `id` = ".$form_item['tweet']);

                            //profile image should be censored
                            if(isset($_POST['profile_img_censored'])) {
                                $update = $mysqli->query("UPDATE `tweets` SET `profile_img_censored` = 1 WHERE `id` = ".$form_item['tweet']);
                            }

                            //media image should be censored
                            if(isset($_POST['media_img_censored'])) {
                                $update = $mysqli->query("UPDATE `tweets` SET `media_img_censored` = 1 WHERE `id` = ".$form_item['tweet']);
                            }
                        }
                        if($form_item['review'] == "deny") {
                            $update = $mysqli->query("UPDATE `tweets` SET `approved` = 0, `reviewed` = 1, `approved_at` = '".time()."' WHERE `id` = ".$_POST['deny']);
                        }
                    }
                }

                ?>


    <div id="page-wrapper">
        
        <?php
            //REVIEW TWEET CODE
            error_reporting(E_ALL);
            require '../../config.php';

            // Create connection
            $mysqli = new mysqli(DB_HOST ,DB_USER,DB_PASS, $project_name);

            // Check connection
            if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }

            //for each reviewed tweet
            foreach($_POST["form"] as $form_item) {
                                       
                if(isset($form_item['review'])) {
                    //if the tweet has been approved 
                    if($form_item['review'] == "approve") {
                        $update = $mysqli->query("UPDATE `tweets` SET `approved` = 1, `reviewed` = 1, `approved_at` = '".time()."' WHERE `id` = ".$form_item['tweet']);

                        //profile image should be censored
                        if(isset($_POST['profile_img_censored'])) {
                            $update = $mysqli->query("UPDATE `tweets` SET `profile_img_censored` = 1 WHERE `id` = ".$form_item['tweet']);
                        }

                        //media image should be censored
                        if(isset($_POST['media_img_censored'])) {
                            $update = $mysqli->query("UPDATE `tweets` SET `media_img_censored` = 1 WHERE `id` = ".$form_item['tweet']);
                        }
                    }
                    //if the tweet has been denied
                    if($form_item['review'] == "deny") {
                        $update = $mysqli->query("UPDATE `tweets` SET `approved` = 0, `reviewed` = 1, `approved_at` = '".time()."' WHERE `id` = ".$form_item['tweet']);
                    }
                }
            }
            $mysqli->close();

            ?>
        
        <!-- GENERATE APPROVED TWEETS -->

        <?php

        error_reporting(E_ALL);
        require '../../config.php';

        // Create connection
        $mysqli = new mysqli(DB_HOST ,DB_USER,DB_PASS, $project_name);

        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        //$_POST['project_name'] = $_GET['project_name'];

        $result = $mysqli->query("SELECT * FROM `tweets` WHERE `reviewed` = 1 AND `approved` = 1 LIMIT 0, 20");

        if ($result->num_rows === 0) {
            echo "<h5>No pending tweets in this project.</h5>";
            exit();
        }

        echo "<h3>Reviewing Approved Tweets</h3>";
        echo "<form id='tweet_review_form' name='tweet_review' action='review-approved-tweets.php' method='POST'>";
        echo "<table id='mytable' class=\"table table-condensed\">";
        echo "<thead><tr><th>Profile Picture</th><th>Tweet Information</th><th>Media</th></tr></thead>";
        echo "<tbody>";

        $counter = 0;

        while($row = $result->fetch_assoc()) {
    
            $user_query = $mysqli->query("SELECT * FROM `users` WHERE `id` = ".$row['user_id']);
            $user_result = $user_query->fetch_assoc();

            echo "<tr>";
            echo "<td><img src='".$user_result['profile_image_url']."' height:'125' width='125' class=\"img-thumbnail\"/><br>";

            echo "<td><strong><h4>".$user_result['screen_name'];
            echo "</h4></strong> <em>".$user_result['name']."</em> @ ".gmdate("H:i:s d-m-Y", $row['created_at'])."<br /><br />";
            //if(strlen($row['media_url']) > 1) {
            //    echo "<img src='".$row['media_url']."' height:'200' width='200'/>";
            //}
            echo "<div class=\"well well-sm\" style=\"background-color: #dff0d8;\">";
            echo $row['text'];
            echo "</div>";
    
            echo "<input type='hidden' name='form[".$counter."][tweet]' value='".$row['id']."' \">";

            if(strlen($row['media_url']) > 1) {
                echo "<input type='checkbox' name='form[".$counter."][profile_image]' value='censor_profile'>Censor Profile Image<br>
                      <input type='checkbox' name='form[".$counter."][media_image]' value='censor_media'>Censor Media Image<br><br>";
            }     
            else {
                //There is no media attached
                echo "<input type='checkbox' name='form[".$counter."][profile_image]' value='censor_profile'>Censor Profile Image<br><br>";
            }  
            //Radio Buttons
            echo "<input class=\"btn btn-success\" type=\"radio\" value=\"approve\" name='form[".$counter."][review]' \">Approve
                  <input class=\"btn btn-danger\" type=\"radio\" value=\"deny\" name='form[".$counter."][review]' \>Deny";
            echo "<br/>";
            echo "<br/>";
            echo  "</td>";
            if(strlen($row['media_url']) > 1) {
                echo "<td><img src='".$row['media_url']."' height:'200' width='200' class=\"thumbnail\" /></td>";
            }
            else {
                //echo empty image
                echo "<td><img src='../../Content/Images/transparent-pixel.png' /></td>";
            }
            echo "</tr>";
            //Increment form counter
            $counter++;
        }
        echo "</tbody>";
        echo "</table>";
        echo "</form>";
        echo "<form>";
        echo "<div class=\"row\" style=\"padding-top: 15px; padding-bottom: 15px; margin-right: 15px;\" >
                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center\" style=\"float: none; margin: 0 auto;\">";
        echo            "<input type='submit' class=\"btn btn-success col-xs-6 col-sm-6 col-md-6 col-lg-6   \" form='tweet_review_form' value='Submit' style=\"float: none; margin: 0 auto;\">";
        echo        "</div>
              </div>";
        echo "</form>";

        $mysqli->close();

        ?>
    

    </div>
</body>

<?php
    include_once("../../Includes/footer-open.php");
    include("../../Includes/footer-branding.php");
    include_once("../../Includes/footer-bootstrap.php");
    include_once("../../Includes/footer-base-style.php");
    include_once("../../Includes/footer-close.php");
?>