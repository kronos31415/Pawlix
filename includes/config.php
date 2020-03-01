<?php
    ob_start();
    session_start();

    date_default_timezone_set("Europe/Warsaw");
    try {
        $conn = new PDO("mysql:host=localhost;dbname=pawlix", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    } catch(PDOException $error) {
        exit("Connection failed: " . $error->getMessage());
    }
     
?>