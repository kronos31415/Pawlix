<?php
    class ErrorMessage {
        public static function show($text) {
            exit("<span class='errorBaner'>$text</span>");
        }
    }
?>