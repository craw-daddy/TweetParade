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

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Project Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-twitter fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div><?php echo $_SESSION['pending_tweets']; ?> New Tweets</div>
                                    </div>
                                </div>
                            </div>
                            <a href="review-pending-tweets.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Moderate Tweets</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-wrench fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>Manage Keywords and Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="project-keywords.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Configure Project</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-image fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>Design Parade</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-style.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Customise</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <?php if($_SESSION['collector_status'] == "Not Collecting") echo "<div class=\"panel panel-danger\">";
                              else echo "<div class=\"panel panel-success\">"; ?>
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <?php if($_SESSION['collector_status'] == "Not Collecting") echo "<i class=\"fa fa-database fa-5x\"></i>";
                                              else echo "<i class=\"fa fa-cog fa-spin fa-5x\"></i>" ?>
                                        
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $_SESSION['collector_status']; ?></div>
                                        <div>Tweet Collector</div>
                                    </div>
                                </div>
                            </div>
                            <a href="manage-collector.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Manage Collector</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- ENTER PARADE -->
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-lg-5 center" style="float:  none; margin: 0 auto">
                        <a href="../Parade/index_new.php">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-flag fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div> <h3>Enter Tweet Parade</h3></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- /.row -->

                <!-- FUTURE CHARTS
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-cog"></i> Project Settings</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge"> <?php echo $_SESSION['project']; ?></span>
                                        <i class="fa fa-fw fa-user"></i> Project Name
                                    </a>
                                    <?php 
                                    //foreach keyword
                                    foreach($_SESSION['total_keywords'] as $keyword=>$word) {
                                        echo "<a href=\"#\" class=\"list-group-item\">";
                                        echo "<span class=\"badge\">".$word."</span>";
                                        echo "<i class=\"fa fa-fw fa-tags\"></i> Keyword </a>";     
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-twitter"></i> Tweet Statistics</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge"> <?php echo $_SESSION['total_tweets']; ?></span>
                                        <i class="fa fa-fw fa-twitter"></i> Total Tweets Overall
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo $_SESSION['approved_tweets']; ?></span>
                                        <i class="fa fa-fw fa-check"></i> Total Approved Tweets
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo $_SESSION['denied_tweets']; ?></span>
                                        <i class="fa fa-fw fa-close"></i> Total Denied Tweets
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo $_SESSION['pending_tweets']; ?></span>
                                        <i class="fa fa-fw fa-dot-circle-o"></i> Total Pending Tweets
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-group"></i> User Statistics</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge"> <?php echo $_SESSION['total_users']; ?></span>
                                        <i class="fa fa-fw fa-user"></i> Total Unique Users
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo $_SESSION['total_whitelist']; ?></span>
                                        <i class="fa fa-fw fa-user-plus"></i> Total Whitelisted Users
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?php echo $_SESSION['total_blacklist']; ?></span>
                                        <i class="fa fa-fw fa-user-times"></i> Total Blacklisted Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        
    </body>
<?php
    include_once("../../Includes/footer-open.php");
    include("../../Includes/footer-branding.php");
    include_once("../../Includes/manage-projects-validation.php");
    include_once("../../Includes/footer-base-style.php");
    include_once("../../Includes/footer-bootstrap.php");
    include_once("../../Includes/footer-close.php");
?>
