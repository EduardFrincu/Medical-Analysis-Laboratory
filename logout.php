<?php
session_start();
$_SESSION["logged_in"] = false;
$_SESSION["CNP"] = "";
header("Location:home_page.php");


if($_SESSION['adm'] == "true"){
    $_SESSION['adm'] = "false";
    header("Location:admin.php");
}
?>