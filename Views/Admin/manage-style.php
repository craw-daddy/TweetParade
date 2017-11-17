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

<div id="page-wrapper">

    <div id="container-fluid">

        <?php $project_name = $_SESSION['project']; ?>

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Styles
                    <small>Manager</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-paint-brush"></i> Current styles</h3>
                </div>

                <div class="panel-body">

                    <form class="theme_selector_form" action="../../Functions/theme-handler.php" method="post"
                          name="theme_selector_form">
                        <ul>
                            <?php
                            require_once('../../config.php');
                            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $project_name);
                            if (mysqli_connect_errno()) {
                                header('Location: no_existing_project.php?project_name=' . $project_name);
                            }

                            $result = $mysqli->query("SELECT * FROM styles");

                            while ($row = mysqli_fetch_array($result)) {

                                $layoutType = $row['layout'];
                                $selected = $row['selected'];

                                if ($selected == 0) {
                                    ?><input type="radio" name="layout"
                                             value="<?php echo $layoutType; ?>"> <?php echo $layoutType; ?><br/>
                                <?php
                                }

                                if ($selected == 1) {
                                    ?><input type="radio" name="layout" value="<?php echo $layoutType; ?>"
                                             checked> <?php echo $layoutType; ?><br/>
                                <?php
                                }
                                $row_count++;
                            }
                            ?>
                        </ul>

                        <input type="hidden" name="project_name" value=<?php echo $project_name ?>/>

                        <div class="col-md-12">
                            <?php
                            if ($row_count > 0) {
                                ?>
                                <div class="col-md-3">
                                    <button class="submit btn btn-primary" type="submit" style="width:100%" name="select">Select Style
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button class="submit btn btn-warning" type="submit" style="width:100%" name="edit">Edit Style
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button class="submit btn btn-danger" type="submit" style="width:100%" name="delete">Delete Style
                                    </button>
                                </div>
                            <?php
                            }
                            ?>
                    </form>

                    <div class="col-md-3">
                        <form name="preview" method="post" action="../../Functions/theme-handler.php">
                            <input type="hidden" name="project_name" value=<?php echo $project_name ?>/>
                            <input type='submit' class ="btn btn-success" style="width:100%" name="preview" value='Preview Style'
                                   onclick="this.form.target='_blank';return true;">
                        </form>
                    </div>
                </div>
                <br />
                <form class="theme_selector_form" action="../../Functions/theme-handler.php" method="post"
                      name="theme_selector_form">
                <div class="col-md-12" style="padding-top: 10px;">
                    <div class="col-md-6" style=" float: none; margin: 0 auto;">
                        <button class="submit btn btn-info" type="submit" style="width:100%" name="new">Create New Style</button>
                    </div>
                </div>
                </form>


            </div>
        </div>
        <!-- End Panel -->
    </div>
    <!-- End row -->
</div>

</div><!-- container -->

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
