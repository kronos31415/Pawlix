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

                $videoHtml = '';
                foreach($season->getVideos() as $video) {
                    $videoHtml .= $this->createVideoSquare($video);
                }

                $seasonHtml .= "<div class='season'> 
                                    <h3>Season $seasonNumber</h3>
                                    <div class='videos'>
                                        $videoHtml
                                    </div>
                                </div>";
            }
            
            return $seasonHtml;
        }

        private function createVideoSquare($video) {
            $id = $video->getId();
            $description = $video->getDescription();
            $title = $video->getTitle();
            $thumbNail = $video->getThumbnail();
            $episodeNumber = $video->getEpisodeNumber();
            $hasWatched = $video->hasSeen($this->userName) ? "<i class='fas fa-check-circle seen'></i>" : "";

            return "<a href='watch.php?id=$id'>
                        <div class='episodeContainer'>
                        
                            <div class='contents'>
                            
                                <img src=$thumbNail>
                                <div class='videoInfo'>
                                    <h3>$episodeNumber. $title</h3>
                                    <span>$description</span>
                                    
                                </div>
                                $hasWatched
                            </div>
                        
                        </div>
            
                    </a>";
        }
    }

?>