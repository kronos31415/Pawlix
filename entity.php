<?php
    require_once("includes/header.php");

    if(!isset($_GET['id'])) {
        ErrorMessage::show('No Id was set.');
    }

    $entityId = $_GET['id'];

    $entity = new Entity($conn, $entityId);
    $preview = new PreviewProvider($conn, $userLoggedIn);
    echo $preview->createPreviewVideo($entity);

    $seasonProvider = new SeasonProvider($conn, $userLoggedIn);
    $seasonProvider->create($entity);
?>