<?php
    class Video {
        private $conn, $sqlData;

        public function __construct($conn, $input) {
            $this->conn = $conn;

            if(is_array($input)) {
                $this->sqlData = $input;
            } else {
                $query = $this->conn->prepare("SELECT * FROM videos WHERE id=:id");
                $query->bindValue(':id', $input);
                $query->execute();

                $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            }

            $this->entity = new Entity($conn, $this->sqlData["entityId"]);
        }

        public function getId() {
            return $this->sqlData['id'];
        }
        public function getDescription() {
            return $this->sqlData['description'];
        }
        public function getTitle() {
            return $this->sqlData['title'];
        }
        public function getFilePath() {
            return $this->sqlData['filePath'];
        }
        public function getEpisodeNumber() {
            return $this->sqlData['episode'];
        }

        public function getSeasonNumber() {
            return $this->sqlData['season'];
        }

        public function getThumbnail() {
            return $this->entity->getThumbnail();
        }

        public function getEntityId() {
            return $this->sqlData['entityId'];
        }

        public function incrementVideo() {
            $query = $this->conn->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
            $query->bindValue(':id', $this->getId());
            $query->execute();
        }

        public function isMovie() {
            return $this->sqlData['isMovie'] == 1;
        }

        public function getSeasonAndEpisode() {
            if($this->isMovie()) {
                return;
            }

            $season = $this->getSeasonNumber();
            $episode = $this->getEpisodeNumber();

            return ("Season $season, Episode $episode");
        }

        public function isInProgress($userName) {
            $query = $this->conn->prepare("SELECT * FROM videoprogress WHERE userName = :userName AND videoId = :id 
                                            AND finisched = 0");

            $query->bindValue(':userName', $userName);
            $query->bindValue(':id', $this->getId());

            $query->execute();
            if($query->rowCount() == 0) 
                return false;
            return true;

        }

        function hasSeen($userName) {
            $query = $this->conn->prepare("SELECT * FROM videoprogress 
                                        WHERE userName = :userName AND videoId = :id AND finisched = 1");
            $query->bindValue(':userName', $userName);
            $query->bindValue(':id', $this->getId());
            $query->execute();

            return $query->rowCount() != 0;
        }

    }

?>