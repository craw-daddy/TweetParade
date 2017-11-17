<?php
include_once("/var/www/html/tweetParade/Includes/session.php");

$project_name = $_SESSION['project'];
$layout = $_REQUEST['layout'];
$event_hashtag = $_REQUEST['event_hashtag'];
$event_logo = $_FILES["event_logo"];
$background = $_FILES["background"];
$twitter_logo_selection = $_REQUEST['twitter_logo_selection'];
$show_header = $_REQUEST['show_header'];
$show_footer = $_REQUEST['show_footer'];
$font_family = $_REQUEST['font_family'];
$h1_font_colour = $_REQUEST['h1_font_colour'];
$h2_font_colour = $_REQUEST['h2_font_colour'];
$h3_font_colour = $_REQUEST['h3_font_colour'];
$h4_font_colour = $_REQUEST['h4_font_colour'];
$font_shadow_colour = $_REQUEST['font_shadow_colour'];
$heading_colour = $_REQUEST['heading_colour'];
$tweet_bar_colour = $_REQUEST['tweet_bar_colour'];
$image_border_colour = $_REQUEST['image_border_colour'];
$link_colour = $_REQUEST['link_colour'];
$hash_colour = $_REQUEST['hash_colour'];
$mention_colour = $_REQUEST['mention_colour'];
$translucent_background_colour = $_REQUEST['translucent_background_colour'];
$translucent_background_opacity = $_REQUEST['translucent_background_opacity'];

$pass = 0;

if($event_logo['error']!=4){
    $logo_image = processImage($event_logo, $project_name, $layout);
    if($logo_image === 0){
        echo $logo_image."<br />";
        echo "Invalid file. <br />";
        echo "type: ".$_event_logo["type"]."<br />";
        echo "size: ".$event_logo["size"]."<br />";
        echo "Please be patient, your style will not be created and you will be redirected to the new style page shortly.";
        header( 'refresh:5; ../create_new_style.php' ) ;
    }else if($logo_image == 1){
        echo $event_logo["name"] . " already exists. <br />";
        echo "Please be patient, your style will not be created and you will be redirected to the new style page shortly.";
        header( 'refresh:5; ../create_new_style.php' ) ;
    }else if($logo_image == 2){
        echo "Return Error Code: " . $event_logo["error"] . "<br />";
        echo "Please be patient, your style will not be created and you will be redirected to the new style page shortly.";
        header( 'refresh:5; ../create_new_style.php' ) ;
    }else{
        $pass = 1;
    }
}else{
    $logo_image = "no_upload";
    $pass = 1;
}

if($pass == 1){

    if($background['error']!=4){
	    $bg_image = processImage($background, $project_name, $layout);
	    if($bg_image === 0){
	        echo $bg_image."<br />";
	        echo "Invalid file. <br />";
	        echo "type: ".$background["type"]."<br />";
	        echo "size: ".$background["size"]."<br />";
	        echo "Please be patient, your style will not be created and you will be redirected to the new style page shortly.";
	        header( 'refresh:5; ../create_new_style.php' ) ;
	    }else if($bg_image == 1){
	        echo $background["name"] . " already exists. <br />";
	        echo "Please be patient, your style will not be created and you will be redirected to the new style page shortly.";
	        header( 'refresh:5; ../create_new_style.php' ) ;
	    }else if($bg_image == 2){
	        echo "Return Error Code: " . $background["error"] . "<br />";
	        echo "Please be patient, your style will not be created and you will be redirected to the new style page shortly.";
	        header( 'refresh:5; ../create_new_style.php' ) ;
	    }else{
	    	//echo "case 1: bg set to: ". $bg_image;
	        processStyle($project_name, $layout, $event_hashtag, $logo_image, $bg_image, $twitter_logo_selection, $show_header, $show_footer, $font_family, $h1_font_colour, $h2_font_colour, $h3_font_colour, $h4_font_colour, $bg_image, $logo_image, $font_shadow_colour, $heading_colour, $tweet_bar_colour, $image_border_colour, $link_colour, $hash_colour, $mention_colour, $translucent_background_colour, $translucent_background_opacity);
	    }
    }else{
        $bg_image = "no_upload";
        //echo "case 2: bg set to: ". $bg_image;
        processStyle($project_name, $layout, $event_hashtag, $logo_image, $bg_image, $twitter_logo_selection, $show_header, $show_footer, $font_family, $h1_font_colour, $h2_font_colour, $h3_font_colour, $h4_font_colour, $bg_image, $logo_image, $font_shadow_colour, $heading_colour, $tweet_bar_colour, $image_border_colour, $link_colour, $hash_colour, $mention_colour, $translucent_background_colour, $translucent_background_opacity);
    }

}


function processImage($img, $project_name, $layout){

  $type = $img["type"];
  $pieces = explode("/", $type);
  $preferedType = "image";

  if ($pieces[0] == $preferedType){
    if ($img["error"] > 0){
        return 2;
      }else{
          mkdir("../../Content/Images/".$project_name."/".$layout, 0777, true);

         if (file_exists("../../Content/Images/".$project_name."/".$layout."/". $img["name"])){
                 move_uploaded_file($img["tmp_name"],
                  "../../Content/Images/".$project_name."/".$layout."/". $img["name"]);
                  $image2 = "../../Content/Images/".$project_name."/".$layout."/". $img["name"];
                  return $image2;
                  break;
                  }
                else{
                  move_uploaded_file($img["tmp_name"],
                  "../../Content/Images/".$project_name."/".$layout."/". $img["name"]);
                  $image2 = "../../Content/Images/".$project_name."/".$layout."/". $img["name"];
                  return $image2;
                  break;
                  }
      }
  }else{
              move_uploaded_file($img["tmp_name"],"../../Content/Images/".$project_name."/".$layout."/". $img["name"]);
              $image2 = "../../Content/Images/".$project_name."/".$layout."/". $img["name"];
              return $image2;
              break;
  }
}


function stripHash($colour){

return $colour;

}


function processStyle($project_name, $layout, $event_hashtag, $event_logo, $background, $twitter_logo_selection, $show_header, $show_footer, $font_family, $h1_font_colour, $h2_font_colour, $h3_font_colour, $h4_font_colour, $bg_image, $logo_image, $font_shadow_colour, $heading_colour, $tweet_bar_colour, $image_border_colour, $link_colour, $hash_colour, $mention_colour, $translucent_background_colour, $translucent_background_opacity){


    $pieces = explode("_", $project_name);
    $event_name = $pieces[1];
    //echo $event_name;

    require_once('../config.php');
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $project_name);

echo "process";
    if (mysqli_connect_errno()) {
      header( 'Location: no_existing_project.php?project_name='.$project_name ) ;
    }

    if($bg_image == "no_upload"){
    	$query = "SELECT * FROM styles WHERE layout='".$layout."'";
    	$result = $mysqli->query($query)->fetch_array(MYSQLI_ASSOC);
    	$bg_image = $result['background'];
    }

    if($logo_image == "no_upload"){
      $query = "SELECT * FROM styles WHERE layout='".$layout."'";
      $result = $mysqli->query($query)->fetch_array(MYSQLI_ASSOC);
      $logo_image = $result['event_logo'];
    }

    $query = "UPDATE styles SET event_name='".$event_name."', event_hash_tag='".$event_hashtag."', event_logo='".$logo_image."', font_family='".$font_family."', h1_font_colour='".stripHash($h1_font_colour)."', h2_font_colour='".stripHash($h2_font_colour)."', h3_font_colour='".stripHash($h3_font_colour)."', h4_font_colour='".stripHash($h4_font_colour)."', font_shadow_colour= '".stripHash($font_shadow_colour)."', heading_colour='".stripHash($heading_colour)."', translucent_background_colour='".stripHash($translucent_background_colour)."', translucent_background_opacity='".stripHash($translucent_background_opacity)."', tweet_bar_colour= '".stripHash($tweet_bar_colour)."', image_border_colour= '".stripHash($image_border_colour)."', twitter_logo_selection='".$twitter_logo_selection."', show_header='".$show_header."', show_footer='".$show_footer."', layout='".$layout."', background='".$bg_image."', link_colour= '".stripHash($link_colour)."', hash_colour= '".stripHash($hash_colour)."', mention_colour= '".stripHash($mention_colour)."' WHERE layout='".$layout."'";

   $mysqli->query($query);

    mysqli_close($mysqli);
    header( 'Location: ../Views/Admin/manage-style.php' ) ;


/*echo $layout;
echo "<br />";
echo "event logo location: ";
echo $event_logo;
echo "<br />";
echo "background location: ";
echo $background;
echo "<br />";
echo "twitter logo selected: ";
echo $twitter_logo_selection;
echo "<br />";
echo "font_family selected: ";
echo $font_family;
echo "<br />";
echo "h1 font colour selected: ";
echo $h1_font_colour;
echo "<br />";
echo "h2 font colour selected: ";
echo $h2_font_colour;
echo "<br />";
echo "h3 font colour selected: ";
echo $h3_font_colour;
echo "<br />";
echo "h4 font colour selected: ";
echo $h4_font_colour;
echo "<br />";
echo "font_shadow_colour selected: ";
echo $font_shadow_colour;
echo "<br />";
echo "heading_colour selected: ";
echo $heading_colour;
echo "<br />";
echo "tweet_bar_colour selected: ";
echo $tweet_bar_colour;
echo "<br />";
echo "image_border_colour selected: ";
echo $image_border_colour;
echo "<br />";
echo "link_colour selected: ";
echo $link_colour;
echo "<br />";
echo "hash_colour selected: ";
echo $hash_colour;
echo "<br />";
echo "mention_colour selected: ";
echo $mention_colour;
echo "<br />";
echo "translucent_background_colour selected: ";
echo $translucent_background_colour;
echo "<br />";
echo "translucent_background_opacity selected: ";
echo $translucent_background_opacity;
echo "<br />";*/

}

?>
