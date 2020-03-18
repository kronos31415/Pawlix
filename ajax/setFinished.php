<?php
    require_once("../includes/config.php");
    
    if(isset($_POST['videoId']) && isset($_POST['userName'])) {
        $query = $conn->prepare("UPDATE videoprogress SET finisched=1, progress = 0
                                 WHERE videoId=:videoId AND userName=:userName");
    
        $query->bindValue(':videoId', $_POST['videoId']);
        $query->bindValue(':userName', $_POST['userName']);
        $query->execute();
    
    } else {
        echo "No userName or VideoId";
    }
?>