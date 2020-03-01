<?php
class Account {
    private $conn;
    private $errorArray = array();

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($fn, $ln, $us, $email, $email1, $pass, $pass1) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($us);
    }

    private function validateFirstName($fn) {
        if(strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameError);
        }
    }

    private function validateLastName($ln) {
        if(strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameError);
        }
    }

    private function validateUserName($un) {
        if(strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$userNameError);
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindValue("un", $un);

        $query->execute();
        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$userNameExist);
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return $error;
        }
    }
}
?>