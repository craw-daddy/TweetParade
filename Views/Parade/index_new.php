<?php
    include_once("../../Includes/session.php");
    if (!isset($_SESSION['project'])) {
        header("Location: /index.php"); // redirects
    }
?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- To make page responsive based on browser size -->
	<title>Tweet Parade</title>
	<link rel="stylesheet" type="text/css" href="assets/styles/fonts.css"> <!-- Font family reference -->
	<link rel="stylesheet" type="text/css" href="assets/styles/normalize.css"> <!-- Base styling defaults -->
	<link rel="stylesheet" type="text/css" href="assets/styles/styles.css"> <!-- Styling for page -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../Scripts/Parade/get-tweets-new.js"></script>
    
</head>

<body>

	<div id="project_name" style="display: none;"><?php 
            $project_name =  $_SESSION['project']; 
            echo $project_name?>
	</div>

	<!-- Dynamic Style Overwrite -->
    <?php 
        require '../../config.php';	 
        include '../../Functions/Parade/get-selected-style.php'; 
    ?> 


	<header class="tweet-parade-header">
		<h1 class="tweet-parade-header__logo">Tweet Parade</h1>
	</header>

	<main>
		<section class="tweet-parade-contain">
			<div class="tweet-card"> <!-- Container for tweet details section - avatar, handle, time, tweet -->
				<div class="tweet-card__details">
					<img class="tweet-card__avatar" src="../../Content/Images/Parade/tweet-parade-default-profile.png">
					<span class="tweet-card__handle">@TweetParade</span>

					<span class="tweet-card__time-tag">2hrs ago</span>

					<span class="tweet-card__title">Tweet</span>

					<p class="tweet-card__tweet">Welcome to the latest version of Tweet Parade. </br><strong>Press F11 to enter fullscreen.</strong></p>
				</div>

				<div class="tweet-card__media"> <!-- Media container which will include the media title and media image uploaded -->
					<span class="tweet-card__media-title">Media</span>

					<img class="tweet-card__media-image" src="../../Content/Images/Parade/tweet-parade-default.png">
				</div>
			</div>
		</section>
	</main>

	<?php 
		$project_name = $_REQUEST['project_name'];
	?> 

	<script type="text/javascript">
			window.onload = function() {

				var style;

				var url = '../../Functions/Parade/return-style.php?project_name='+document.getElementById("project_name").innerHTML;

                $.getJSON(url, function(data) {

                		// BACKGROUND STYLING
                		document.body.style.background = "url(../"+data['background']+") no-repeat center center fixed";
                        document.body.style.backgroundSize = "100% 100%";

                        // HANDLE STYLINH
                        document.getElementsByClassName("tweet-card__handle")[0].style.color = data['h1_font_colour'];
                        document.getElementsByClassName("tweet-card__handle")[0].style.fontFamily = data['font_family'];
						document.getElementsByClassName("tweet-card__handle")[0].style.fontSize = "xx-large";

						// TIMESTAMP STYLING
						document.getElementsByClassName("tweet-card__time-tag")[0].style.background = data['h3_font_colour'];

						// TWEET STYLING
                        document.getElementsByClassName("tweet-card__tweet")[0].style.color = data['h2_font_colour'];
                        document.getElementsByClassName("tweet-card__tweet")[0].style.fontFamily = data['font_family'];
                        document.getElementsByClassName("tweet-card__tweet")[0].style.fontSize = "large";


                        // AVATAR STYLING
                        var rgb = hexToRgb(data['image_border_colour']);
						var avatarBoxShadow = new RGBA(rgb.r, rgb.g, rgb.b, data['translucent_background_opacity']*0.01);
                        document.getElementsByClassName("tweet-card__avatar")[0].style.boxShadow = "-3px 3px 0px 3px " + avatarBoxShadow.getCSS();
                        document.getElementsByClassName("tweet-card__avatar")[0].style.webkitBoxShadow = "-3px 3px 0px 3px " + avatarBoxShadow.getCSS();

                        // TWEET CARD STYLING
                        var rgb2 = hexToRgb(data['translucent_background_colour']);
						var cardBackground = new RGBA(rgb2.r, rgb2.g, rgb2.b, data['translucent_background_opacity']*0.01);
                        document.getElementsByClassName("tweet-card")[0].style.background = cardBackground.getCSS();

                        var rgb3 = hexToRgb(data['h4_font_colour']);
						var cardBoxShadow = new RGBA(rgb3.r, rgb3.g, rgb3.b, data['translucent_background_opacity']*0.01);
                        document.getElementsByClassName("tweet-card")[0].style.boxShadow = "-3px 3px 0px 3px " + cardBoxShadow.getCSS();
                        document.getElementsByClassName("tweet-card")[0].style.webkitBoxShadow = "-3px 3px 0px 3px " + cardBoxShadow.getCSS();


                });

			}

			function RGBA(red,green,blue,alpha) {
			    this.red = red;
			    this.green = green;
			    this.blue = blue;
			    this.alpha = alpha;
			    this.getCSS = function() {
			        return "rgba("+this.red+","+this.green+","+this.blue+","+this.alpha+")";
			    }
			}

			function hexToRgb(hex) {
			    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
			    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
			    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
			        return r + r + g + g + b + b;
			    });

			    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
			    return result ? {
			        r: parseInt(result[1], 16),
			        g: parseInt(result[2], 16),
			        b: parseInt(result[3], 16),
			    } : null;
			}
		</script>

	<footer id="brand">NeST Software Lab &copy; 2016</footer>

</body>



</html>