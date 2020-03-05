<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitazer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");
$account = new Account($conn);
    if(isset($_POST['submitButton'])) {
        $user = FormSanitazer::sanitazeUser($_POST['userName']);
        $password = FormSanitazer::sanitazePassword($_POST['password']);

        $success = $account->login($user, $password);
        
        if($success) {
            header("Location: index.php");
        }
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
                   <?php echo $account->getError(Constants::$wrongLogin); ?>
                   <input type = "text" placeholder = "User Name" name = "userName" required>
                   <input type = "password" placeholder = "Password" name = "password" required>
                   <input type = "submit" name = "submitButton" value="SUBMIT">
                   <a href="register.php" class = "signInMessage">Don't have account yet? Please register here</a>
               </form> 
            </div>
        </div>
    </body>
</html>