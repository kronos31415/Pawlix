<?php
    require_once("includes/config.php");
    require_once("includes/classes/PreviewProvider.php");
    require_once("includes/classes/CategoryContainers.php");
    require_once("includes/classes/EntityProvider.php");
    require_once("includes/classes/Entity.php");
    require_once("includes/classes/ErrorMessage.php");
    require_once("includes/classes/SeasonProvider.php");
    require_once("includes/classes/Video.php");
    require_once("includes/classes/Season.php");
    require_once("includes/classes/VideoProvider.php");


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

     <div class='topNav'>
         <div class='logoContainer'>
            <a href = 'index.php'>
                <img src='assets/img/pawlix.png'>
            </a>
         </div>

         <ul class = 'navLinks'>
            <li><a href='index.php'>Home</a></li>
            <li><a href='shows.php'>Tv Shows</a></li>
            <li><a href='movies.php'>Movies</a></li>
         </ul>

         <div class = 'rightItems'>
            <a href='search.php'><i class="fas fa-search"></i></a>
            <a href='profile.php'><i class="fas fa-male"></i></a>
        </div>
     </div>