<?php
require_once("includes/header.php");

if(!isset($_GET['id'])) {
    ErrorMessage::show('No Id was set.');
}

$video = new Video($conn, $_GET['id']);
$video->incrementVideo();

?>

<div class='watchContainer'>


    <div class='videoControls watchNav'>
        <button onclick='goToPreviousPage()'><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle();  ?></h1>
    </div>

    <video controls autoplay >
        <source src = "<?php echo $video->getFilePath(); ?>" type='video/mp4'>
    </video>
</div>

<script>
    initialize();
</script>