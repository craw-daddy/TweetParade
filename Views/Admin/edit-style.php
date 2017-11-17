<?php
include_once("../../Includes/session.php");
if (!isset($_SESSION['project'])) {
    header("Location: /index.php"); // redirects
}
include_once("../../Functions/project-statistics.php");
include_once("../../Includes/header-open.php");
include_once("../../Includes/header-base-style.php");
include_once("../../Styles/header-base-style.php");
include_once("../../Includes/header-close.php");
?>
<body>

<?php
include_once("../../Includes/nav-menus.php");
?>

<?php
$project_name = $_SESSION['project'];
$style = $_GET['style'];

$style_data = getData($project_name, $style)->fetch_array(MYSQLI_ASSOC);


function getData($project_name, $style)
{

    require_once('../../config.php');
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $project_name);

    $query = "SELECT * FROM `styles` WHERE `layout` = \"" . $style . "\"";
    $record = $mysqli->query($query);

    mysqli_close($mysqli);
    return $record;
}

?>

<div id="page-wrapper">

    <div id="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edit
                    <small>Styles Manager</small>
                </h1>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-photo"></i> Create Style</h3>
            </div>
            <br/>

            <div class="panel-body">
                <form class="style_editor_form" action="../../Functions/style-editor.php" method="post"
                      name="style_editor_form" enctype="multipart/form-data" style="padding: 10px;">


                    <label for="layout">layout name:</label><input type="text" name="layout"
                                                                   value=<?php echo "\"" . $style_data['layout'] . "\"" ?> maxlength="120"/><br/>

                    <label for="event_hashtag">main event hashtag:</label><input type="text" name="event_hashtag"
                                                                                 value=<?php echo "\"" . $style_data['event_hash_tag'] . "\"" ?>  maxlength="120"/><br/>

                    <label for="event_logo">event logo:</label>
                    <input type="file" name="event_logo" id="event_logo" value=<?php echo $style_data['event_logo'] ?>>
                    <strong><span style="color: #A80000">(Current logo set to: <?php echo $style_data['event_logo'] ?>
                            )</span></strong><br/><br/>

                    <label for="background">background image:</label>
                    <input type="file" name="background" id="background" value=<?php echo $style_data['background'] ?>>
                    <strong><span
                            style="color: #A80000">(Current background set to: <?php echo $style_data['background'] ?>
                            )</span></strong><br/><br/>

                    <!-- <label for="twitter_logo_selection">twitter logo selection:</label>
                    <?php
                    if ($style_data['twitter_logo_selection'] == 1) {
                        ?>
                        <input type="radio" name="twitter_logo_selection" value="1" checked> Blue
                        <input type="radio" name="twitter_logo_selection" value="0"> White<br/><br/>
                    <?php
                    }

                    if ($style_data['twitter_logo_selection'] == 0) {
                        ?>
                        <input type="radio" name="twitter_logo_selection" value="1"> Blue
                        <input type="radio" name="twitter_logo_selection" value="0" checked> White<br/><br/>
                    <?php
                    }
                    ?>

                    <label for="show_header">wall header:</label>
                    <?php
                    if ($style_data['show_header'] == 1) {
                        ?>
                        <input type="radio" name="show_header" value="1" checked> Show
                        <input type="radio" name="show_header" value="0"> Hide<br/><br/>
                    <?php
                    }

                    if ($style_data['show_header'] == 0) {
                        ?>
                        <input type="radio" name="show_header" value="1"> Show
                        <input type="radio" name="show_header" value="0" checked> Hide<br/><br/>
                    <?php
                    }
                    ?>

                    <label for="show_footer">wall footer:</label>
                    <?php
                    if ($style_data['show_footer'] == 1) {
                        ?>
                        <input type="radio" name="show_footer" value="1" checked> Show
                        <input type="radio" name="show_footer" value="0"> Hide<br/><br/>
                    <?php
                    }

                    if ($style_data['show_footer'] == 0) {
                        ?>
                        <input type="radio" name="show_footer" value="1"> Show
                        <input type="radio" name="show_footer" value="0" checked> Hide<br/><br/>
                    <?php
                    }
                    ?>
 -->



                    <label for="font_family">font family:</label>
                    <?php
                    if ($style_data['font_family'] == "Times New Roman,Georgia,Serif") {
                        ?>
                        <select name="font_family">
                            <option value="Times New Roman,Georgia,Serif">"Times New Roman",Georgia,Serif</option>
                            <option value="Arial, sans-serif">"Arial", sans-serif</option>
                            <option value="Comic Sans, Comic Sans MS, cursive">"Comic Sans", Comic Sans MS, cursive
                            </option>
                            <option value="Hammersmith One">"Hammersmith One"</option>
                        </select><br/>
                    <?php
                    }

                    if ($style_data['font_family'] == "Arial, sans-serif") {
                        ?>
                        <select name="font_family">
                            <option value="Arial, sans-serif">"Arial", sans-serif</option>
                            <option value="Times New Roman,Georgia,Serif">"Times New Roman",Georgia,Serif</option>
                            <option value="Comic Sans, Comic Sans MS, cursive">"Comic Sans", Comic Sans MS, cursive
                            </option>
                            <option value="Hammersmith One">"Hammersmith One"</option>
                        </select><br/>
                    <?php
                    }

                    if ($style_data['font_family'] == "Comic Sans, Comic Sans MS, cursive") {
                        ?>
                        <select name="font_family">
                            <option value="Comic Sans, Comic Sans MS, cursive">"Comic Sans", Comic Sans MS, cursive
                            </option>
                            <option value="Times New Roman,Georgia,Serif">"Times New Roman",Georgia,Serif</option>
                            <option value="Arial, sans-serif">"Arial", sans-serif</option>
                            <option value="Hammersmith One">Hammersmith One</option>
                        </select><br/>
                    <?php
                    }

                    if ($style_data['font_family'] == "Hammersmith One") {
                        ?>
                        <select name="font_family">
                            <option value="Hammersmith One">Hammersmith One</option>
                            <option value="Comic Sans, Comic Sans MS, cursive">"Comic Sans", Comic Sans MS, cursive
                            </option>
                            <option value="Times New Roman,Georgia,Serif">"Times New Roman",Georgia,Serif</option>
                            <option value="Arial, sans-serif">"Arial", sans-serif</option>
                        </select><br/>
                    <?php
                    }
                    ?>

                    <label for="h1_font_colour">handle font colour:</label>
                    <input name="h1_font_colour" type="color" class="color"
                           value=<?php echo $style_data['h1_font_colour'] ?>><br/>

                    <label for="h2_font_colour">tweet font colour:</label>
                    <input name="h2_font_colour" type="color" class="color"
                           value=<?php echo $style_data['h2_font_colour'] ?>><br/>

                    <label for="h3_font_colour">timestamp border colour:</label>
                    <input name="h3_font_colour" type="color" class="color"
                           value=<?php echo $style_data['h3_font_colour'] ?>><br/>

                    <label for="h4_font_colour">container shadow colour:</label>
                    <input name="h4_font_colour" type="color" class="color"
                           value=<?php echo $style_data['h4_font_colour'] ?>><br/>

                    <label for="font_shadow_colour">font shadow colour:</label>
                    <input name="font_shadow_colour" type="color" class="color"
                           value=<?php echo $style_data['font_shadow_colour'] ?>><br/>

<!--                     <label for="heading_colour">heading colour:</label>
                    <input name="heading_colour" type="color" class="color"
                           value=<?php echo $style_data['heading_colour'] ?>><br/> -->

                    <label for="tweet_bar_colour">avatar bar colour:</label>
                    <input name="tweet_bar_colour" type="color" class="color"
                           value=<?php echo $style_data['tweet_bar_colour'] ?>><br/>

                    <label for="image_border_colour">image border colour:</label>
                    <input name="image_border_colour" type="color" class="color"
                           value=<?php echo $style_data['image_border_colour'] ?>><br/>
<!-- 
                    <label for="link_colour">link colour:</label>
                    <input name="link_colour" type="color" class="color"
                           value=<?php echo $style_data['link_colour'] ?>><br/>

                    <label for="hash_colour">hashtag colour:</label>
                    <input name="hash_colour" type="color" class="color"
                           value=<?php echo $style_data['hash_colour'] ?>><br/>

                    <label for="mention_colour">mention colour:</label>
                    <input name="mention_colour" type="color" class="color"
                           value=<?php echo $style_data['mention_colour'] ?>><br/> -->

                    <label for="translucent_background_colour">translucent background colour:</label>
                    <input name="translucent_background_colour" type="color" class="color"
                           value=<?php echo $style_data['translucent_background_colour'] ?>><br/><br/>

                    <label for="translucent_background_opacity">translucent background opacity:</label>
                    <input type="range" min="0" max="100"
                           value=<?php echo $style_data['translucent_background_opacity'] ?> step="5"
                           onchange="showValue(this.value)" name="translucent_background_opacity"/>
                    <span id="range"><?php echo $style_data['translucent_background_opacity'] ?></span>%
                    <script type="text/javascript">
                        function showValue(newValue) {
                            document.getElementById("range").innerHTML = newValue;
                        }
                    </script>
                    <br/>

                    <input type="hidden" name="project_name" value=<?php echo $project_name ?>/>

                    <div class="six columns">
                        <button class="submit btn btn-success" type="submit" style="width:100%" name="update">Confirm
                            Changes
                        </button>
                    </div>

                </form>


                <form class="sponsor_logo_editor_form" action="php/add_sponsor_logo.php" method="post"
                      name="sponsor_logo_editor_form" enctype="multipart/form-data" style="padding: 10px;">

                    <label for="new_sponsor_logo">sponsor logo: </label>
                    <input type="file" name="new_sponsor_logo" id="new_sponsor_logo"
                           value=<?php echo $style_data['event_sponsors'] ?>> <strong><span style="color: #A80000">(Max of 5)</span></strong><br/><br/>

                    <input type="hidden" name="project_name" value=<?php echo $project_name ?>/>
                    <input type="hidden" name="style_name" value="<?php echo $style ?>"/>

                    <div class="six columns">
                        <button class="submit btn btn-primary" type="submit" style="width:100%" name="update">Add
                            Sponsor Logo
                        </button>
                    </div>

                </form>


                <form class="remove_sponsor_logo_form" action="php/remove_sponsor_logo.php" method="post"
                      onsubmit="return Validate('keyword')" name="remove_sponsor_logo_form" style="padding: 10px;">
                    <h5>Current Logos:</h5>
                    <ul>
                        <?php

                        //require_once('../config.php');
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $project_name);
                        if ($mysqli->connect_error) {
                            header('Location: no_existing_project.php?project_name=' . $project_name);
                        }

                        $query = "SELECT * FROM `styles` WHERE `layout` = \"" . $style . "\"";
                        $result = $mysqli->query($query);

                        while ($row = mysqli_fetch_array($result)) {
                            $logos = $row['event_sponsors'];
                            $pieces = explode(";", $logos);
                            foreach ($pieces as $key => $value) {
                                if (empty($value)) {
                                    unset($pieces[$key]);
                                }
                            }
                            if (!empty($pieces)) {
                                foreach ($pieces as $logo) {
                                    $logo_pieces = explode("/", $logo);
                                    ?>
                                    <li><input type="checkbox" name="sponsors[]"
                                               value="<?php echo (string)$logo; ?>"><?php echo $logo_pieces[6]; ?></li>
                                <?php
                                }
                            } else {
                                echo "NO SPONSORS SET YET";
                            }

                        }
                        ?>
                    </ul>
                    <input type="hidden" name="project_name" value=<?php echo $project_name ?>/>
                    <input type="hidden" name="style_name" value="<?php echo $style ?>"/>

                    <div class="six columns">
                        <button class="submit btn btn-danger" type="submit" style="width:100%">Remove Selected Logos
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>


</div>
<!-- container -->


<script type="text/javascript">
    function Validate(str) {
        if (!validateForm()) {
            alert("Must select at least one " + str + " to remove.");
            return false;
        }
        return true
    }
    function validateForm() {
        var c = document.getElementsByTagName('input');
        for (var i = 0; i < c.length; i++) {
            if (c[i].type == 'checkbox') {
                if (c[i].checked) {
                    return true
                }
            }
        }
        return false;
    }
</script>

<!-- End Document
================================================== -->
</body>

<?php
include_once("../../Includes/footer-open.php");
include("../../Includes/footer-branding.php");
include_once("../../Includes/manage-projects-validation.php");
include_once("../../Includes/footer-base-style.php");
include_once("../../Includes/footer-bootstrap.php");
include_once("../../Includes/footer-close.php");
?>
