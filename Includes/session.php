<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../../Views/User/index.php");
    }
?>
