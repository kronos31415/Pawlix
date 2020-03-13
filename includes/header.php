<?php
    require_once("includes/config.php");
    require_once("includes/classes/PreviewProvider.php");
    require_once("includes/classes/Entity.php");

    if(!isset($_SESSION['userLogedIn'])) {
        header("Location: register.php");
    }
    $userLoggedIn = $_SESSION['userLogedIn'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My pawlix clone Netflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
        <script src="https://kit.fontawesome.com/16fed3d78e.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
     <div class='wraper'>