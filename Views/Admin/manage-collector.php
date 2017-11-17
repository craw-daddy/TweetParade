<?php
    include_once("../../Includes/session.php");
    include_once("../../Functions/project-statistics.php");
    include_once("../../Includes/header-open.php");
    include_once("../../Includes/header-base-style.php");
    include_once("../../Styles/header-base-style.php");
    include_once("../../Includes/header-close.php");

    $project_name = $_SESSION['project'];
?>
<body>

    <?php
        include_once("../../Includes/nav-menus.php");
    ?>
    <div id="page-wrapper">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Manage Collector
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-xs-12 col-md-8 col-lg-6 center">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-database fa-fw"></i> Project Keywords </h3>
                        </div>
                        <div class="panel-body">
			                <?php
                            include_once("../../Functions/collector-functions.php");
			                $collector_status = getCollectorStatus($project_name);

			                if($collector_status == 0){
				                ?>
				                <div class="alert alert-danger" role="alert">
                                    <h5>Current Project: <strong><?php echo $project_name ?></strong></h5>
                                    <h5>Current Status: <strong><span style="color: #A80000">NOT COLLECTING</span></strong></h5>
                                </div>
				                <?php 
                                    $_SESSION['collector_status'] = "Not Collecting";
			                } 

			                if($collector_status >= 1){
				                ?>
				                <div class="alert alert-success" role="alert">
                                    <h5>Current Project: <strong><?php echo $project_name ?></strong></h5>
                                    <h5>Current Status: <strong><span style="color: #33AA33">COLLECTING</span> <i class="fa fa-cog fa-spin"></i> </strong></h5>
                                </div>
				                <?php
                                    $_SESSION['collector_status'] = "Collecting";
			                }
			                ?>

                            <form class="start_stop_collector_form" action="../../Functions/start-stop-collector.php" method="post" name="start_stop_collector_form">
                                <div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-right: 15px;" >
                                    <div class="center" style="float: none; margin: 0 auto; padding-left: 30px">
                                        <button type="submit" value="start" name="start" class="btn btn-success col-xs-12 col-md-8 col-lg-6" >Start Collector</button>
                                        <button type="submit" value="stop" name="stop" class="btn btn-danger col-xs-12 col-md-8 col-lg-6" >Stop Collector</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
			    <br />
                <br />
            </div>


        

    </div>
</body>
<?php
    include_once("../../Includes/footer-open.php");
    include("../../Includes/footer-branding.php");
    include_once("../../Includes/manage-projects-validation.php");
    include_once("../../Includes/footer-base-style.php");
    include_once("../../Includes/footer-bootstrap.php");
    include_once("../../Includes/footer-close.php");
?>
