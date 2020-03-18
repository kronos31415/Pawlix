<?php
require_once("../includes/config.php");
    if(isset($_POST['videoId']) && isset($_POST['userName'])) {
        $query = $conn->prepare("SELECT progress FROM videoprogress
                                 WHERE videoId=:videoId AND userName=:userName");
    
        $query->bindValue(':videoId', $_POST['videoId']);
        $query->bindValue(':userName', $_POST['userName']);
        $query->execute();
        
        $progress = $query->fetchColumn();
        echo $progress;
    
    } else {
        echo "No userName or VideoId";
    }

?>