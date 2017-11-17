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

        <?php  $project_name = $_SESSION['project']; ?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Styles <small>Manager</small>
                        </h1>
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
