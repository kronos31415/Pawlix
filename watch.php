<?php
require_once("includes/header.php");

if(!isset($_GET['id'])) {
    ErrorMessage::show('No Id was set.');
}

$video = new Video($conn, $_GET['id']);
$video->incrementVideo();

?>

<div class='watchContainer'>
    <video controls autoplay >
        <source src = "<?php echo $video->getFilePath(); ?>" type='video/mp4'>
    </video>
</div>