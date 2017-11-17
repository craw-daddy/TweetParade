<?php
    include_once("../../Includes/session.php");
    if (!isset($_SESSION['project'])) {
        header("Location: ../index.php"); // redirects
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

    <div id="page-wrapper">

        <div id="container-fluid">

                <?php  $project_name = $_SESSION['project']; ?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Create <small>New Style</small>
                        </h1>
                    </div>
                </div>


                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-photo"></i> Create Style</h3>
                            </div>
                            <br />
                    <div class="panel-body">
                        <form class="style_creator_form" action="../../Functions/style-creator.php" method="post" name="style_creator_form" enctype="multipart/form-data" style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                    
                        <label for="layout">layout name:</label><input type="text" name="layout" value="" maxlength="120" /><br />

                        <label for="event_hashtag">main event hashtag:</label><input type="text" name="event_hashtag" value="" maxlength="120" /><br />
                        
                        <label for="event_logo">event logo:</label>
                        <input type="file" name="event_logo" id="event_logo"><br /><br />

                        <label for="background">background image:</label>
                        <input type="file" name="background" id="background"><br /><br />

<!--                         <label for="twitter_logo_selection">twitter logo selection:</label>
                        <input type="radio" name="twitter_logo_selection" value="1"> Blue
                        <input type="radio" name="twitter_logo_selection" value="0" checked> White<br /><br />

                        <label for="twitter_logo_selection">wall header:</label>
                        <input type="radio" name="show_header" value="1"> Show
                        <input type="radio" name="show_header" value="0" checked> Hide<br /><br />

                        <label for="twitter_logo_selection">wall footer:</label>
                        <input type="radio" name="show_footer" value="1"> Show
                        <input type="radio" name="show_footer" value="0" checked> Hide<br /><br /> -->

                        <label for="font_family">font family:</label>
                        <select name="font_family">
                            <option value="Times New Roman,Georgia,Serif">"Times New Roman",Georgia,Serif</option>
                            <option value="Arial, sans-serif">"Arial", sans-serif</option>
                            <option value="lobsterbold">"Lobster Bold"</option>
                            <option value="Comic Sans, Comic Sans MS, cursive">"Comic Sans", Comic Sans MS, cursive</option>
                            <option value="Hammersmith One">'Hammersmith One'</option>
                        </select><br />

                        <label for="h1_font_colour">handle font colour:</label>
                        <input name="h1_font_colour" type="color" class="color"><br />

                        <label for="h2_font_colour">tweet font colour:</label>
                        <input name="h2_font_colour" type="color" class="color"><br />

<!--                         <label for="h3_font_colour">avatar border colour:</label>
                        <input name="h3_font_colour" type="color" class="color"><br /> -->

                        <label for="h4_font_colour">container shadow colour:</label>
                        <input name="h4_font_colour" type="color" class="color"><br />

                        <label for="font_shadow_colour">font shadow colour:</label>
                        <input name="font_shadow_colour" type="color" class="color"><br />
<!-- 
                        <label for="heading_colour">heading colour:</label>
                        <input name="heading_colour" type="color" class="color"><br /> -->

                        <label for="tweet_bar_colour">tweet bar colour:</label>
                        <input name="tweet_bar_colour" type="color" class="color"><br />

                        <label for="image_border_colour">avatar border colour:</label>
                        <input name="image_border_colour" type="color" class="color"><br />

<!--                         <label for="link_colour">link colour:</label>
                        <input name="link_colour" type="color" class="color"><br />

                        <label for="hash_colour">hashtag colour:</label>
                        <input name="hash_colour" type="color" class="color"><br />

                        <label for="mention_colour">mention colour:</label>
                        <input name="mention_colour" type="color" class="color"><br /> -->

                        <label for="translucent_background_colour">translucent background colour:</label>
                        <input name="translucent_background_colour" type="color" class="color"><br /><br />

                        <label for="translucent_background_opacity">translucent background opacity:</label>
                        <input type="range" min="0" max="100" value="0" step="5" onchange="showValue(this.value)" name="translucent_background_opacity" />
                        <span id="range">0</span>%
                        <script type="text/javascript">
                        function showValue(newValue)
                        {
                            document.getElementById("range").innerHTML=newValue;
                        }
                        </script>
                        <br />

                        <input type="hidden" name="project_name" value=<?php echo $project_name ?> />
                        <div class="six columns">
                            <button class="submit btn btn-success" type="submit" style="width:100%" name="create">Create Style</button>
                        </div>
                    </form>
                    </div>

                </div>
                <!-- /.row -->

        </div><!-- container -->

    </div>

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
