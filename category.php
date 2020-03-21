<?php
    require_once("includes/header.php");

    if(!isset($_GET['id'])) {
        ErrorMessage::show('No id passed');
    }

    $preview = new PreviewProvider($conn, $userLoggedIn);
    echo $preview->createCategoryPreviewVideo($_GET['id']);

    $container = new CategoryContainers($conn, $userLoggedIn);
    echo $container->showCategory($_GET['id']);
?>