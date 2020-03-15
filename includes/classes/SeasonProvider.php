<?php
    class SeasonProvider {
        private $conn, $userName;

        public function __construct($conn, $userName) {
            $this->conn = $conn;
            $this->userName = $userName;
        }

        public function create($entity) {
            $seasons = $entity->getSeasons();

            if(sizeof($seasons) == 0) {
                return;
            }

            $seasonHtml = "";
            foreach($seasons as $season) {
                $seasonNumber = $season->getSeasonNumber();

                $seasonHtml .= "<div class='season'> 
                                    <h3>Season $seasonNumber</h3>
                                </div>";
            }
            // var_dump($seasonHtml);
            
            return $seasonHtml;
        }
    }

?>