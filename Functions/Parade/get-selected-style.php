<?php 

error_reporting(E_ALL);

// Create connection
$mysqli = new mysqli(DB_HOST ,DB_USER,DB_PASS, $_SESSION['project']);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$result = $mysqli->query("SELECT * FROM `styles` where `selected` = 1");


if ($result->num_rows === 0) {
    echo "No such stylesheet";
    exit();
}

echo $row['background'];
echo "<style> ";

while($row = $result->fetch_assoc()) {

	echo 'html {
		font-family: '.$row['font_family'].' !important;
		}';

	echo 'body {
		font-family: '.$row['font_family'].' !important;
			background: url("'.$row['background'].'") no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		} 
		';

	echo '.header {
			background: '.$row['heading_colour'].';
		} 
		';

	echo '.footer {
			background: '.$row['heading_colour'].';
		} 
		';	

	if($row['twitter_logo_selection'] == 0) {
		echo '.twitter-logo {
				background: url(../../images/uploads/twitter_logo_white.png) no-repeat scroll 0px 0px / 100% 100% transparent;
				display: inline-block;
				height: 27px;
				width: 33px;
				vertical-align: middle;
				padding-right: 30px;
			} 
			';
	}
	else {
		echo '.twitter-logo {
				background: url(../images/uploads/twitter_logo_blue.png)no-repeat scroll 0px 0px / 100% 100% transparent;
				display: inline-block;
				height: 27px;
				width: 33px;
				vertical-align: middle;
				padding-right: 30px;
			} 
			';
	}

	list($r, $g, $b) = sscanf($row['translucent_background_colour'], "#%02x%02x%02x");
	$opacity = $row['translucent_background_opacity']/100;
		
	echo '#media-box {
			background: rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo '#tweet .data {
			background: rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';


list($r, $g, $b) = sscanf($row['font_shadow_colour'], "#%02x%02x%02x");
	$opacity = $row['translucent_background_opacity']/100;

	echo 'h1 {
			color: '.$row['h1_font_colour'].';
			text-shadow: 0 -1px 0 rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo 'h2 {
			color: '.$row['h2_font_colour'].';
			text-shadow: 0 -1px 0 rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo 'h3 {
			color: '.$row['h3_font_colour'].';
			text-shadow: 0 -1px 0 rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo 'h4 {
			color: '.$row['h4_font_colour'].';
			text-shadow: 0 -1px 0 rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo ' #tweet .data h1 {
			color: '.$row['h1_font_colour'].';
			text-shadow: 0 -1px 0 rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo 'h2:after {
			color: '.$row['tweet_bar_colour'].';
			text-shadow: 0 -1px 0 rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo 'h3:after {
			color: '.$row['h1_font_colour'].';
			text-shadow: 0 -1px 0 rgba('.$r.', '.$g.', '.$b.', '.$opacity.');
		} 
		';

	echo 'h4:after {
			background:'.$row['tweet_bar_colour'].';
		} 
		';

	echo '#tweet .profile-image img {
			background:'.$row['image_border_colour'].';
		} 
		';

}
echo "</style> ";



?>

