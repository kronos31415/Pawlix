<?php
    class PreviewProvider {
        private $conn, $userName;

        public function __construct($conn, $userName) {
            $this->conn = $conn;
            $this->userName = $userName;
        }

        public function createTvShowPreviewVideo() {
            $entitiesArray = EntityProvider::getTvShows($this->conn, null, 1);
            if(sizeof($entitiesArray) == 0) {
                ErrorMessage::show("No Tv shows available");
            }

            return $this->createPreviewVideo($entitiesArray[0]);
        }

        public function createMoviesPreviewVideo() {
            $entitiesArray = EntityProvider::getMovies($this->conn, null, 1);
            if(sizeof($entitiesArray) == 0) {
                ErrorMessage::show("No Movies available");
            }

            return $this->createPreviewVideo($entitiesArray[0]);
        }

        public function createCategoryPreviewVideo($categoryId) {
            $entitiesArray = EntityProvider::getEntities($this->conn, $categoryId, 1);
            if(sizeof($entitiesArray) == 0) {
                ErrorMessage::show("No Movies available");
            }

            return $this->createPreviewVideo($entitiesArray[0]);
        }

        public function createPreviewVideo($entity) {
            if($entity == null) {
                $entity = $this->getRandomEntity();
            }
            $name = $entity->getName();
            $id = $entity->getId();
            $preview = $entity->getPreview();
            $thumbnail = $entity->getThumbnail();

            $videoId = VideoProvider::getEntityVideo($this->conn, $id, $this->userName);

            $video = new Video($this->conn, $videoId);

            $seasonAndEpisode = $video->getSeasonAndEpisode();

            $heading = $video->isMovie() ? "" : "<h4>$seasonAndEpisode</h4>";

            $playButton = $video->isInProgress($this->userName) ? "Continue watching" : "PLAY";


            return "<div class='previewContainer'>
                        <img src='$thumbnail' class='previewImage' hidden>
            
                        <video autoplay muted class = 'previewVideo' onended = 'displayImage()'>
                            <source src='$preview' type='video/mp4'>
                        </video>

                        <div class='previewOverlay'>
                            <div class='mainDetails'>
                                <h3>$name</h3>
                                $heading

                                <div class='buttons'>
                                    <button onclick='playNext($videoId)'><i class='fas fa-play'></i>  $playButton</button>
                                    <button onclick='volumeToogle(this)'><i class='fas fa-volume-mute'></i></button>
                                </div>

                            </div>
                            
                        </div>
                    </div>";
        }

        public function createEntityPreviewSquare($entity) {
            $id = $entity->getId();
            $thumbnail = $entity->getThumbnail();
            $name = $entity->getName();

            return "<a href='entity.php?id=$id'>
            
                        <div class='previewContainer small'>
                            <img src='$thumbnail' name='$name'/>
                        </div>
                    </a>";
        }

        public function getRandomEntity() {
            $entity = EntityProvider::getEntities($this->conn, null, 1);
            return $entity[0];
        }
    }
?>