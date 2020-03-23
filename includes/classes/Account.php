<?php
class Account {
    private $conn;
    private $errorArray = array();

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateProfile($fn, $ln, $email, $un) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewEmail($email, $un);

        if(empty($this->errorArray)) {
            // Enter new data to dataBase
            return true;
        }
        return false;

    }

    public function register($fn, $ln, $us, $email, $email2, $pass, $pass2) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($us);
        $this->validateEmails($email, $email2);
        $this->validatePasswords($pass, $pass2);

        if(empty($this->errorArray)) {
            return $this->insertUserData($fn, $ln, $us, $email,$pass);
        }
        return false;
    }

    public function login($us, $pass) {
        $pass = hash("sha512", $pass);
        $query = $this->conn->prepare("SELECT * FROM users WHERE password =:pass AND userName=:user");
        $query->bindValue(':pass', $pass);
        $query->bindValue(':user', $us);
        $query->execute();

        if($query->rowCount() == 1) {
            return true;
        }
        array_push($this->errorArray, Constants::$wrongLogin);
        return false;

    }

    private function insertUserData($fn, $ln, $us, $email,$pass) {
        $pass = hash("sha512", $pass);

        $query = $this->conn->prepare("INSERT INTO users(firstName, lastName, username, email, password)
                                     VALUES(:fn, :ln, :us, :email, :pass)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":us", $us);
        $query->bindValue(":email", $email);
        $query->bindValue(":pass", $pass);

        return $query->execute();
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

    private function validateEmails($email, $email2) {
        if($email != $email2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailWrongFormat);
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindValue(":email", $email);
        $query->execute();
        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailExist);
        }

    } 

    private function validateNewEmail($email, $un) {
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailWrongFormat);
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE email = :email AND userName != :username");
        $query->bindValue(":email", $email);
        $query->bindValue(":username", $un);

        $query->execute();
        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailExist);
        }

    } 

    private function validatePasswords($pass, $pass2) {
        if($pass != $pass2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        } 
        if(strlen($pass) < 5 || strlen($pass) > 25) {
            array_push($this->errorArray, Constants::$passwordLength);
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>" . $error . "</span>";
        }
    }
}
?>