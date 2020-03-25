<?php
    require_once("PayPal_SDK/autoload.php");

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'ARYN03MPH-2ZB8p2AHFo2KzoxCxyZrU7RZN7Z9ITjUR8i8DTKRYILfuEZGypbhxmY6pDPWL98Pt-usEv',     // ClientID
            'EKs_qhih5xEEEwum6joPI37h2wOUBnbICcMPwfwei_ZdD5tZB5-z_dwcqTDS9aiOjlwI5ikqqMMmWDEO'      // ClientSecret
        )
);
?>