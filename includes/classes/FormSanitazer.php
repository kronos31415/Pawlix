<?php
    class FormSanitazer {
        public static function sanitazeString($inputString) {
            $inputString = strip_tags($inputString);
            $inputString = trim($inputString);
            $inputString = strtolower($inputString);
            $inputString = ucfirst($inputString);
    
            return $inputString;
        }
    }
?>