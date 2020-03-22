<?php
require_once("../includes/config.php");
require_once("../includes/classes/SearchResultProvider.php");
require_once("../includes/classes/EntityProvider.php");
require_once("../includes/classes/Entity.php");
require_once("../includes/classes/PreviewProvider.php");

    if(isset($_POST['search']) && isset($_POST['user'])) {
        
        $srp = new SearchResultProvider($conn, $_POST['user']);
        echo $srp->getResult($_POST['search']);
    
    } else {
        echo "No userName or VideoId";
    }

?>