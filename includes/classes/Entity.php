<?php
    class Entity {
        private $conn, $sqlData;

        public function __construct($conn, $input) {
            $this->conn = $conn;

            if(is_array($input)) {
                $this->sqlData = $input;
            } else {
                $query = $this->conn->prepare("SELECT * FROM entities WHERE id=:id");
                $query->bindValue(':id', $input);
                $query->execute();

                $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
?>