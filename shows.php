<?php
    require_once("includes/header.php");

    $preview = new PreviewProvider($conn, $userLoggedIn);
    echo $preview->createTvShowPreviewVideo();

    $container = new CategoryContainers($conn, $userLoggedIn);
    echo $container->showTvShowCategories();
?>