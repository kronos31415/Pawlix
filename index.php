<?php
    require_once("includes/config.php");
    if(!isset($_SESSION['userLogedIn'])) {
        header("Location: register.php");
    }
?>