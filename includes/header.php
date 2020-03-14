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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/16fed3d78e.js" crossorigin="anonymous"></script>
        <script src="assets/js/script.js"></script>
    </head>
    
    <body>
     <div class='wraper'>