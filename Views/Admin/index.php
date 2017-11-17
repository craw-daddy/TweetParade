<?php
    include_once("../../Includes/session.php");
    if (isset($_SESSION['project'])) {
        header("Location: ../../Views/Admin/project-home.php");
    }
    include_once("../../Includes/header-open.php");
    include_once("../../Includes/header-base-style.php");
    include_once("../../Includes/header-close.php");
?>
<body>

    <?php
        include_once("../../Includes/nav-menus.php");
    ?>
    <div id="page-wrapper">
        <div class="col-lg-12">
            <h1 class="page-header">Welcome, <?php echo htmlentities($_SESSION['username']); ?></h1>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-4 center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-plus fa-fw"></i> Create New Project </h3>
                    </div>
                    <div class="panel-body">
                        <form action="../../Functions/new-project.php" method="post" name="new_project_form">
                              <div class="form-group">
                                    <label for="project_name">Project Name:</label>
                                    <input class="form-control" type="text" name="project_name" placeholder="project name" required onkeyup="nospaces(this)"/>
                              </div>
                              <button type="submit" class="btn btn-success">Create Project</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-8 col-lg-4 center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-folder-open fa-fw"></i> Manage Existing Project </h3>
                    </div>
                    <div class="panel-body">
                        <form action="../../Functions/set-project.php" method="post" name="manage_project">
                              <div class="form-group">
                                <label for="project_name">Project Name:</label>
                                <select class="form-control" name="project_name">
						            <?php
							            require_once('../../config.php');
							            $sql="SHOW DATABASES";
							            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
							            $result=mysqli_query($link,$sql);
							            $row_getRS = mysqli_fetch_assoc($result);

							            while( $row = mysqli_fetch_row( $result ) ):
								            if (($row[0]!="information_schema") && ($row[0]!="mysql")) {
									            if (strpos($row[0],'tweetparade') !== false) {
									                $projectName = $row[0]."\r\n";
										            ?>
										            <option value=<?php echo (string)$projectName; ?>><?php echo $projectName; ?></option>
					    			            <?php
									            }

							                    }
							            endwhile;
						            ?>
					            </select>
                              </div>
                              <button type="submit" class="btn btn-primary">Manage Existing Project</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-8 col-lg-4 center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-close fa-fw"></i> Delete Existing Project </h3>
                    </div>
                    <div class="panel-body">
                        <form action="../../Functions/delete-project.php" method="post" name="manage_project">
                              <div class="form-group">
                                    <label for="project_name">Project Name:</label>
                                    <select class="form-control" name="project_name">
						                <?php
							                require_once('../../config2.php');
							                $sql="SHOW DATABASES";
							                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
							                $result=mysqli_query($link,$sql);
							                $row_getRS = mysqli_fetch_assoc($result);

							                while( $row = mysqli_fetch_row( $result ) ):
								                if (($row[0]!="information_schema") && ($row[0]!="mysql")) {
									                if (strpos($row[0],'tweetparade') !== false) {
									                    $projectName = $row[0]."\r\n";
										                ?>
										                <option value=<?php echo (string)$projectName; ?>><?php echo $projectName; ?></option>
					    			                <?php
									                }

							                        }
							                endwhile;
						                ?>
					                </select>
                              </div>
                              <button type="submit" class="btn btn-danger">Delete Existing Project</button>
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