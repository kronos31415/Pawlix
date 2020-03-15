<?php
    class SeasonProvider {
        private $conn, $userName;

        public function __construct($conn, $userName) {
            $this->conn = $conn;
            $this->userName = $userName;
        }

        public function create($entity) {
            $entity->getSeasons();
        }
    }

?>