<?php
    class FormSanitazer {
        public static function sanitazeString($inputString) {
            $inputString = strip_tags($inputString);
            $inputString = trim($inputString);
            $inputString = strtolower($inputString);
            $inputString = ucfirst($inputString);
            return $inputString;
        }

        public static function sanitazeUser($inputString) {
            $inputString = strip_tags($inputString);
            $inputString = trim($inputString);
            return $inputString;
        }

        public static function sanitazeEmail($inputString) {
            $inputString = strip_tags($inputString);
            $inputString = trim($inputString);
            return $inputString;
        }

        public static function sanitazePassword($inputString) {
            $inputString = strip_tags($inputString);
            return $inputString;
        }
    }
?>