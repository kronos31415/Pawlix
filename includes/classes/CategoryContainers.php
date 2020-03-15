<?php
    class CategoryContainers {
        private $conn, $userName;

        public function __construct($conn, $userName) {
            $this->conn = $conn;
            $this->userNAme = $userName;
        }

        public function showCategories() {
            $query = $this->conn->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='previewCategories'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $html .= $this->getCategoryHtml($row, null, true, true);
            }

            return $html . "</div>";
        }

        public function getCategoryHtml($sqlData, $title, $isTvShow, $isMovie) {
            $categoryId = $sqlData['id'];
            $title = $title == null ? $sqlData["name"] : $title;
            return $title . "<br>";
        }
    }
?>