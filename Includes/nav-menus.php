<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../../index.php">
            <img src="../../Content/Images/tweet-parade-logo.png" height="58%" alt="TweetParade-Logo">
        </a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">

        <!-- UPDATE SESSION VARIABLES FOR DISPLAY IN THE NAV -->
        <?php include("../Functions/nav-statistics.php"); ?>
        <!--<li class="dropdown msgs">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li>
                    <a href="#">
                        <div>
                            <strong>John Smith</strong>
                            <span class="pull-right text-muted">
                                <em>Yesterday</em>
                            </span>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <strong>John Smith</strong>
                            <span class="pull-right text-muted">
                                <em>Yesterday</em>
                            </span>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <strong>John Smith</strong>
                            <span class="pull-right text-muted">
                                <em>Yesterday</em>
                            </span>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        <!--</li>-->
        <!-- /.dropdown msgs -->


        <!--<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-tasks">
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 1</strong>
                                <span class="pull-right text-muted">40% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 2</strong>
                                <span class="pull-right text-muted">20% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 3</strong>
                                <span class="pull-right text-muted">60% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                    <span class="sr-only">60% Complete (warning)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 4</strong>
                                <span class="pull-right text-muted">80% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Tasks</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-tasks -->
        <!-- </li>  -->
        <!-- /.dropdown -->

        <?php if (isset($_SESSION['project'])) {


            echo "<li class=\"dropdown\">
                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" style=\"cursor: pointer; cursor: hand;\" onclick=\"update_nav_info()\">
                            <i class=\"fa fa-bell fa-fw\"></i><font id=\"project\">" . htmlentities($_SESSION['project']) . "</font><i class=\"fa fa-caret-down\"></i>
                        </a>
                        <ul class=\"dropdown-menu dropdown-alerts\">
                            <li>
                                <a href=\"../../Views/Admin/review-pending-tweets.php\">
                                    <div>
                                        <i class=\"fa fa-twitter fa-fw\"></i><em id=\"pending\"> " . $_SESSION['pending_tweets'] . "</em> New Tweets
                                    </div>
                                </a>
                            </li>
                            <li class=\"divider\"></li>
                            <li>
                                <a href=\"../../Views/Admin/manage-collector.php\">
                                    <div>
                                        <i class=\"fa fa-database fa-fw\"></i> " . $_SESSION['collector_status'] . "
                                    </div>
                                </a>
                            </li>
                            <li class=\"divider\"></li>
                            <li><a href=\"../../Views/Admin/select-new-project.php\"><i class=\"fa fa-sign-out fa-fw\"></i> Leave Project</a>
                            </li>

                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li>";
        }
        ?>



        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?php echo htmlentities($_SESSION['username']) ?> <i
                    class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="../../Views/User/user-settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="../../Views/User/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <!-- .navbar sidebar-->
    <br/>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li style="padding-top: 9px"></li>
                <!--<li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                <!--</li>-->
                <li>
                    <a href="../../Views/Admin/index.php"><i class="fa fa-home fa-fw"></i> Home</a>
                </li>

                <?php if (isset($_SESSION['project'])) {
                    echo "
                                <li>
                                    <a href=\"../../Views/Admin/select-new-project.php\"><i class=\"fa fa-archive fa-fw\"></i> Projects</a>
                                </li>
                                <li>
                                    <a href=\"../../Views/Admin/tweet-collector.php\"><i class=\"fa fa-database fa-fw\"></i> Tweet Collector</a>
                                </li>
                                <li>
                                    <a href=\"#\"><i class=\"fa fa-wrench fa-fw\"></i> Project Configuration<span class=\"fa arrow\"></span></a>
                                    <ul class=\"nav nav-second-level\">
                                        <li>
                                            <a href=\"../../Views/Admin/black-white-listing.php\">Black/White Listing</a>
                                        </li>
                                        <li>
                                            <a href=\"../../Views/Admin/keywords.php\">Keywords</a>
                                        </li>
                                        <li>
                                            <a href=\"#\">Styles <span class=\"fa arrow\"></span></a>
                                            <ul class=\"nav nav-third-level\">
                                                <li>
                                                    <a href=\"../../Views/Admin/new-styles.php\">New Style</a>
                                                </li>
                                                <li>
                                                    <a href=\"../../Views/Admin/select-styles.php\">Select Style</a>
                                                </li>
                                                <li>
                                                    <a href=\"../../Views/Admin/edit-styles.php\">Edit Style</a>
                                                </li>
                                                <li>
                                                    <a href=\"../../Views/Admin/delete-styles.php\">Delete Style</a>
                                                </li>
                                            </ul>
                                            <!-- /.nav-third-level -->
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href=\"#\"><i class=\"fa fa-twitter fa-fw\"></i> Manage Tweets<span class=\"fa arrow\"></span></a>
                                    <ul class=\"nav nav-second-level\">

                                        <li>
                                            <a href=\"../../Views/Admin/review-pending-tweets.php\">Pending</a>
                                        </li>
                                        <li>
                                            <a href=\"../../Views/Admin/review-approved-tweets.php\">Approved</a>
                                        </li>
                                        <li>
                                            <a href=\"../../Views/Admin/review-denied-tweets.php\">Declined</a>
                                        </li>

                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href=\"../../Views/Parade/index.php\"><i class=\"fa fa-flag fa-fw\"></i> Enter Parade</a>
                                </li>";
                }
                ?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<!-- ./navbar-sidebar-->
<script type="text/javascript" src="../../Scripts/Base/nav-bar-update-stats.js"></script>