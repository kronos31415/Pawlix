<?php
    require_once("includes/header.php");

    $preview = new PreviewProvider($conn, $userLoggedIn);
    echo $preview->createMoviesPreviewVideo();

    $container = new CategoryContainers($conn, $userLoggedIn);
    echo $container->showMoviesCategories();
?>