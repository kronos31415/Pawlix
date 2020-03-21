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

        public function showTvShowCategories() {
            $query = $this->conn->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='previewCategories'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $html .= $this->getCategoryHtml($row, null, true, false);
            }

            return $html . "</div>";
        }

        public function showMoviesCategories() {
            $query = $this->conn->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='previewCategories'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $html .= $this->getCategoryHtml($row, null, true, false);
            }

            return $html . "</div>";
        }


        public function showCategory($id, $title = null) {
            $query = $this->conn->prepare("SELECT * FROM categories WHERE id=:id");
            $query->bindValue(':id', $id);
            $query->execute();

            $html = "<div class='previewCategories noScroll'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $html .= $this->getCategoryHtml($row, $title, true, true);
            }

            return $html . "</div>";
        }

        public function getCategoryHtml($sqlData, $title, $isTvShow, $isMovie) {
            $categoryId = $sqlData['id'];
            $title = $title == null ? $sqlData["name"] : $title;

            if($isTvShow && $isMovie) {

                $entities = EntityProvider::getEntities($this->conn, $categoryId, (int)10);

            } else if($isTvShow) {

                $entities = EntityProvider::getTvShows($this->conn, $categoryId, (int)10);

            } else {

                $entities = EntityProvider::getMovies($this->conn, $categoryId, (int)10);

            }

            if(sizeof($entities) == 0) {
                return;
            }
            $preview = new PreviewProvider($this->conn, $this->userName);
            $entitiesHtml = "";
            foreach($entities as $entity) {
                $entitiesHtml .= $preview->createEntityPreviewSquare($entity);
            }

            return "<div class='category'>
                        <a href='category.php?id=$categoryId'> 
                            <h3>$title</h3>
                        </a>

                        <div class='entities'>
                            $entitiesHtml
                        </div>
                    </div>";
        }
    }
?>