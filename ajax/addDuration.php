<?php
require_once("../includes/config.php");
    
if(isset($_POST['videoId']) && isset($_POST['userName'])) {
    $query = $conn->prepare("SELECT * FROM videoprogress
                             WHERE videoId=:videoId AND userName=:userName");

    $query->bindValue(':videoId', $_POST['videoId']);
    $query->bindValue(':userName', $_POST['userName']);
    $query->execute();

    if($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO videoprogress(videoId, userName)
                                    VALUES(:videoId, :userName)");

        $query->bindValue(':videoId', $_POST['videoId']);
        $query->bindValue(':userName', $_POST['userName']);
        $query->execute();
    }

} else {
    echo "No userName or VideoId";
}
?>