<?php
    include_once("../../Includes/session.php");
    if (!isset($_SESSION['project'])) {
        header("Location: /index.php"); // redirects
    }
    include_once("../../Includes/header-open.php");
    include_once("../../Includes/header-base-style.php");
    include_once("../../Styles/header-base-style.php");
    include_once("../../Includes/parade-includes.php");
    include_once("../../Includes/header-close.php");
?>


    <!-- Dynamic Style Overwrite -->
    <?php 
        require '../../config.php';	 
        include '../../Functions/Parade/get-selected-style.php'; 
    ?> 

	<div class="body_container">
		<div id="project_name" style="display: none;"><?php 
            $project_name = $_SESSION['project']; 
            echo $project_name?>
		</div>

			<div class="tweet-box" id="tweet-box">
				<div id="tweet" class="clearfix">
				    <div class="profile-image" id="profile_image">
				        <img alt="logo" src="../../Content/Images/Parade/tweet-parade-default-profile.png" />
				    </div>
				    <div class="data">

				        <div id="screen_name"><h1>Tweet_Parade_1.0</h1></div>


				        <div id="text"><h2>Welcome to the latest version of Tweet Parade. </br><strong>Press F11 to enter fullscreen.</strong></h2></div>

				        <!--                    <h4><a href="http://spyrestudios.com/">http://spyrestudios.com/</a></h4>-->
				        <div class="user-statistics">
				            <ul class="numbers">
				                <li>Tweets<strong id="tweets">89</strong></li>
				                <li>Following<strong id="following">15</strong></li>
				                <li class="nobrdr">Followers<strong id="followers">141</strong></li>
				            </ul>
				        </div>
				    </div>
				</div>
			</div>
			<div id="media-box">
				<div class="media-content">
				    <div class="media-header">
				        <h2>Media</h2>
				    </div>
				    <div class="media-body" id="attached_media">
				        <img alt="default media" src="../../Content/Images/Parade/tweet-parade-default.png " />
				    </div>
				</div>
			</div>

		</div>


		<script type="text/javascript">
			window.onload = function() { myFunction(); }

			function myFunction() {

			}			
		</script>
		<!--CHECK THESE
		<script src="scripts/script.js" type="text/javascript"></script>
		<script src="scripts/transitions.js" type="text/javascript"></script>
		<script src="scripts/new_automatic_update.js"></script>-->

		<div id="timediv"></div>
	<!-- </div> -->


</body>


<?php 
	$project_name = $_REQUEST['project_name'];
	//include 'layout_functions/get_footer.php'; 
?> 


<!-- End Document
================================================== -->
</html>
