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
                        Configuration <small>Keywords</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-xs-12 col-md-8 col-lg-6 center">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tags fa-fw"></i> Project Keywords </h3>
                        </div>
                        <div class="panel-body">
                                <div class="list-group">
                                    <?php

						                require_once('../../config.php');
						                $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name);
						                if (mysqli_connect_errno()) {
						                    header( 'Location: no_existing_project.php?project_name='.$project_name ) ;
						                }
						 
						                $query = "SELECT * FROM keywords";
						                $result = mysqli_query($con,$query);

						                while($row = mysqli_fetch_array($result)){
							                $keyWord = $row['phrase'];
							                ?>
                                            <a href="#" class="list-group-item">
                                                <span class="badge"> <?php echo (string)$keyWord ?></span>
                                                <i class="fa fa-fw fa-tag"></i> Keyword
                                            </a>
			    			                <?php
						                }
					                ?>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-8 col-lg-6 center">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tag fa-fw"></i> Add Keywords </h3>
                        </div>
                        <div class="panel-body">
                            <form class="add_keyword_form" action="../../Functions/add-keywords.php" method="post" name="add_keyword_form">

                                <div class="form-group">
                                    <label for="new_keyword">New Keyword:</label>
                                    <input type="text" class="form-control" id="new_keyword" name="new_keyword" placeholder="keyword" required>
                                </div>

						        <button type="submit" class="btn btn-success">Add Keyword</button>
			                </form>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-8 col-lg-6 center">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tag fa-fw"></i> Remove Keywords </h3>
                        </div>
                        <div class="panel-body">
                            <form class="remove_keyword_form" action="../../Functions/remove-keywords.php" method="post" onsubmit="return Validate('keyword')" name="remove_keyword_form">
					        <label>Current Keywords:</label>
                            <?php

						        require_once('../../config.php');
						        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $project_name);
						        if (mysqli_connect_errno()) {
						            header( 'Location: no_existing_project.php?project_name='.$project_name ) ;
						        }
						 
						        $query = "SELECT * FROM keywords";
						        $result = mysqli_query($con,$query);

						        while($row = mysqli_fetch_array($result)){
							        $keyWord = $row['phrase'];
							        ?><div class="checkbox"><label><input type="checkbox" name="keywords[]" value="<?php echo (string)$keyWord; ?>"><?php echo $keyWord; ?></label></div>
			    			        <?php
						        }
					        ?>
				        <button type="submit" class="btn btn-danger">Remove Selected Keywords</button> 
			        </form>
                        </div>
                    </div>
                </div>

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
