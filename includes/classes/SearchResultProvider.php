<?php
class SearchResultProvider {
    private $conn, $userName;

    public function __construct($conn, $userName) {
        $this->conn = $conn;
        $this->userName = $userName;
    }

    public function getResult($input) {
        $result = EntityProvider::getSearchEntities($this->conn, $input);
        $html = "<div class = 'previewCategories noscroll'>";
        $html .= $this->getResultHtml($result);
        
        return $html . "</div>";
    }

    private function getResultHtml($entities) {
        if(sizeof($entities) == 0) {
            return;
        }
        $preview = new PreviewProvider($this->conn, $this->userName);
        $entitiesHtml = "";
        foreach($entities as $entity) {
            $entitiesHtml .= $preview->createEntityPreviewSquare($entity);
        }

        return "<div class='category'>
                    <div class='entities'>
                        $entitiesHtml
                    </div>
                </div>";
    }
}

?>