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
            $name = $entity->getName();
            $id = $entity->getId();
            $preview = $entity->getPreview();
            $thumbnail = $entity->getThumbnail();

            return "<div class='previewContainer'>
                        <img src='$thumbnail' class='previewImage' hidden>
            
                        <video autoplay muted class = 'previewVideo'>
                            <source src='$preview' type='video/mp4'>
                        </video>

                        <div class='previewOverlay'>
                            <div class='mainDetails'>
                                <h3>$name</h3>

                                <div class='buttons'>
                                    <button><i class='fas fa-play'></i>  PLAY</button>
                                    <button onclick='volumeToogle(this)'><i class='fas fa-volume-mute'></i></button>
                                </div>

                            </div>
                            
                        </div>
                    </div>";
        }

        public function getRandomEntity() {
            $query = $this->conn->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
            return new Entity($this->conn, $row);
        }
    }
?>