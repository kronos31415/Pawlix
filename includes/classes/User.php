<?php
    class User {
        private $conn, $sqlData;

        public function __construct($conn, $user) {
            $this->conn = $conn;
            
            
            $query = $conn->prepare("SELECT * FROM users WHERE username = :user");
            $query->bindValue(':user', $user);
            $query->execute();
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }

        public function getFirstName() {
            return $this->sqlData['firstName'];
        }

        public function getLAstName() {
            return $this->sqlData['lastName'];
        }

        public function getEmail() {
            return $this->sqlData['email'];
        }

    }
?>