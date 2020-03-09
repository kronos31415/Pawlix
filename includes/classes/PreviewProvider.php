<?php
    class PreviewProvider {
        private $conn, $userName;

        public function __construct($conn, $userName) {
            $this->conn = $conn;
            $this->userNAme = $userName;
        }

        public function createPreviewVideo($entity) {
            if($entity == null) {
                $entity = $this->getRandomEntity();
            }
            echo $entity;
        }

        public function getRandomEntity() {
            $query = $this->conn->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
            echo $row['name'];
        }
    }
?>