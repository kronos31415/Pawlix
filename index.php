<?php
    require_once("includes/config.php");
    require_once("includes/classes/PreviewProvider.php");

    if(!isset($_SESSION['userLogedIn'])) {
        header("Location: register.php");
    }
    $userLoggedIn = $_SESSION['userLogedIn'];

    $preview = new PreviewProvider($conn, $userLoggedIn);
    $preview->createPreviewVideo(null);
?>