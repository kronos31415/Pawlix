<?php
    require_once("../includes/config.php");
    
    if(isset($_POST['videoId']) && isset($_POST['userName']) && isset($_POST['time'])) {
        $query = $conn->prepare("UPDATE videoprogress SET progress=:progress, dateModified = NOW()
                                 WHERE videoId=:videoId AND userName=:userName");
    
        $query->bindValue(':videoId', $_POST['videoId']);
        $query->bindValue(':userName', $_POST['userName']);
        $query->bindValue(':progress', $_POST['time']);
        $query->execute();
    
    } else {
        echo "No userName or VideoId";
    }
?>