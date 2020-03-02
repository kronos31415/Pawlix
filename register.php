<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitazer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($conn);
    if(isset($_POST['submitButton'])) {
        $firstName = FormSanitazer::sanitazeString($_POST['firstName']);
        $lastName = FormSanitazer::sanitazeString($_POST['lastName']);
        $user = FormSanitazer::sanitazeUser($_POST['userName']);
        $email = FormSanitazer::sanitazeEmail($_POST['email']);
        $email2 = FormSanitazer::sanitazeEmail($_POST['email2']);
        $password = FormSanitazer::sanitazePassword($_POST['password']);
        $password2 = FormSanitazer::sanitazePassword($_POST['password2']);

        $account->register($firstName, $lastName, $user, $email, $email2, $password, $password2);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My pawlix clone Netflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>
    
    <body>
        <div class='signInContiner'>
            <div class='column'>

                <div class="header">
                    <img src = "assets/img/pawlix.png"/>
                    <h3>Sign Up</h3>
                    <span>to register to Pawlix.</span>
                </div>
               <form method = "POST">
                   <?php echo $account->getError(Constants::$firstNameError); ?>
                   <input type = "text" placeholder = "First Name" name = "firstName" required>

                   <?php echo $account->getError(Constants::$lastNameError); ?>
                   <input type = "text" placeholder = "Last Name" name = "lastName" required> 

                   <?php echo $account->getError(Constants::$userNameError); ?>
                   <?php echo $account->getError(Constants::$userNameExist); ?>
                   <input type = "text" placeholder = "User Name" name = "userName" required>

                   <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                   <?php echo $account->getError(Constants::$emailWrongFormat); ?>
                   <?php echo $account->getError(Constants::$emailExist); ?>
                   <input type = "email" placeholder = "Emai" name = "email" required>
                   <input type = "email" placeholder = "Email" name = "email2" required>

                   <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                   <?php echo $account->getError(Constants::$passwordLength); ?>
                   <input type = "password" placeholder = "Password" name = "password" required>
                   <input type = "password" placeholder = "Confirm password" name = "password2" required>

                   <input type = "submit" name = "submitButton" value="SUBMIT">
                   <a href="login.php" class = "signInMessage">Do You have account? Please sign in here</a>
               </form> 
            </div>
        </div>
    </body>
</html>