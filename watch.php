<?php
$isNavbarVis = true;
require_once("includes/header.php");

if(!isset($_GET['id'])) {
    ErrorMessage::show('No Id was set.');
}

$video = new Video($conn, $_GET['id']);
$video->incrementVideo();

$nextVideo = VideoProvider::getUpNext($conn, $video);

?>

<div class='watchContainer'>


    <div class='videoControls watchNav'>
        <button onclick='goToPreviousPage()'><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle();  ?></h1>
    </div>

    <div class='videoControls upNext' style="display : none">
        <button onclick="restartVideo();"><i class="fas fa-redo-alt"></i></button>
    
        <div class='nextContainer'>
            <h1>Next: </h1>
            <h3><?php echo $nextVideo->getTitle()?></h3>
            <h3><?php echo $nextVideo->getSeasonAndEpisode()?></h3>

            <button class = 'playNext' onclick="playNext(<?php echo $nextVideo->getId()?>);"><i class="fas fa-play"></i> PLAY</button>
        </div>


    </div>

    

    <video controls autoplay onended="showUpNext();">
        <source src = "<?php echo $video->getFilePath(); ?>" type='video/mp4'>
    </video>
</div>

<script>
    initialize("<?php echo $video->getId(); ?>","<?php echo $userLoggedIn; ?>");
</script>