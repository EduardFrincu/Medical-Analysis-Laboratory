<?php
    session_start();
    $_SESSION["logged_in"] = false;
    $_SESSION["CNP"] = "";
    header("Location:home_page.php");
    exit();
    ?>