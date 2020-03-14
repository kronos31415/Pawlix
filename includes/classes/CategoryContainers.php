<?php
    class CategoryContainers {
        private $conn, $userName;

        public function __construct($conn, $userName) {
            $this->conn = $conn;
            $this->userNAme = $userName;
        }

        public function showCategories() {
            $query = $this->conn->prepare("SELECT  name FROM categories");
            $query->execute();

            $html = "<div class='previewCategories'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $html .= $row['name'];
            }

            return $html . "</div>";
        }
    }
?>