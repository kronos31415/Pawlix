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
    }

?>