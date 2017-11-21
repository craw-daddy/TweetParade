<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header("Location: ../Admin/index.php"); // redirects
    }
    include_once("../../Includes/header-open.php");
    include_once("../../Includes/header-user-style.php");   
    include_once("../../Includes/header-close.php");
?>
    <body>
        <?php include_once("../../Functions/db-functions.php"); ?>
        <?php include_once("../../Functions/user-account-functions.php"); ?>
        
        <?php 
        if(isset($_POST["submit"])) {

            //$required_fields = arry("username", "password");
            //validate_presences($required_fields);
//            $errors;

            if(empty($errors)) {
                //attempt login
                $username = $_POST["username"];
                $password = $_POST["password"];

                $found_user = attempt_login($username, $password);

                if($found_user) {
                    //success
                    //mark the user as logged in
                    $_SESSION["user_id"] = $found_user["id"];
                    $_SESSION["username"] = $found_user["username"];
                    //$_SESSION["project"] = "tweetparade";
                    header("Location: ../Admin/index.php"); // redirects
                }
                else {
                    //failure
                    $_SESSION["message"] = "Username/Password is incorrect.";
                }
            }  
       } 
        ?>
        <div class="container">

          <form action="index.php" method="post" class="form-signin">
            <img class ="img-responsive" src="../../Content/Images/tweet-parade-logo.png" alt="tweet parade logo"/>
              <br />
              <div class="alert alert-info alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <i class="fa fa-bell fa-5x"></i><em>Tweet Parade</em> is currently in beta, please report any bugs to NeST.
                </div>

              <?php 
                if(isset($_SESSION["message"])) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">";
                    echo $_SESSION["message"];
                    echo "</div>";
                }
              ?>
            <label for="inputEmail" class="sr-only">Username</label>
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" value="<?php echo htmlentities($username)?>" required>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
              <div class="row" style="padding-top: 15px; padding-bottom: 15px">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                    <img src="../../Content/Images/Branding/nest-logo-small.png" height="40px" alt="nest" />
                    <img style="padding-left: 50px;" src="../../Content/Images/Branding/university-of-liverpool.png" height="30px" alt="uol" />
                </div>
            </div>
          </form>

        </div> <!-- /container -->

    </body>
<?php
    include_once("../../Includes/footer-open.php");
    include_once("../../Includes/footer-bootstrap.php");
    include_once("../../Includes/footer-base-style.php");
    include_once("../../Includes/footer-close.php");
?>
