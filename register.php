<?php
require_once("includes/classes/FormSanitazer.php");
    if(isset($_POST['submitButton'])) {
        $firstName = FormSanitazer::sanitazeString($_POST['firstName']);
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
                   <input type = "text" placeholder = "First Name" name = "firstName" required>
                   <input type = "text" placeholder = "Last Name" name = "lastName" required> 
                   <input type = "text" placeholder = "User Name" name = "userName" required>
                   <input type = "email" placeholder = "Emai" name = "email" required>
                   <input type = "email" placeholder = "Email" name = "email2" required>
                   <input type = "password" placeholder = "Password" name = "password" required>
                   <input type = "password" placeholder = "Confirm password" name = "password2" required>
                   <input type = "submit" name = "submitButton" value="SUBMIT">
                   <a href="login.php" class = "signInMessage">Do You have account? Please sign in here</a>
               </form> 
            </div>
        </div>
    </body>
</html>