<?php
    require_once("includes/header.php");
    require_once("includes/classes/Account.php");
    require_once("includes/classes/User.php");
    require_once("includes/classes/FormSanitazer.php");
    require_once("includes/classes/Constants.php");

    $detailsMessage = '';
    $passwordMessage = '';

    if(isset($_POST['saveDetails'])) {
        $account = new Account($conn);

        $firstName = FormSanitazer::sanitazeString($_POST['firstName']);
        $lastName = FormSanitazer::sanitazeString($_POST['lastName']);
        $email = FormSanitazer::sanitazeString($_POST['email']);

        if($account->updateProfile($firstName, $lastName, $email, $userLoggedIn)) {
            $detailsMessage = "<div class=allertSuccess>
                                    Profile update succesfuly
                                </div>";
        } else {
            $error = $account->getFirstError();
            $detailsMessage = "<div class=allertError>
                                    $error
                                </div>";
        }

    }


    if(isset($_POST['savePassword'])) {
        $account = new Account($conn);

        $oldPassword = FormSanitazer::sanitazePassword($_POST['oldPassword']);
        $newPassword = FormSanitazer::sanitazePassword($_POST['newPassword']);
        $newPassword2 = FormSanitazer::sanitazePassword($_POST['newPassword2']);

        if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedIn)) {
            $passwordMessage = "<div class=allertSuccess>
                                    Password update succesfuly
                                </div>";
        } else {
            $error = $account->getFirstError();
            $passwordMessage = "<div class=allertError>
                                    $error
                                </div>";
        }

    }

?>

<div class='settingsContainer column'>
    <div class='formSection'>
        <form method='POST'>
            <h2>Profile Details</h2>

            <?php
                $user = new User($conn, $userLoggedIn);
                $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : $user->getFirstName();
                $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : $user->getlastName();
                $email = isset($_POST['email']) ? $_POST['email'] : $user->getEmail();
            ?>

            <input type = 'text' name ='firstName' placeholder='First Name' value = <?php echo $firstName; ?>>
            <input type = 'text' name ='lastName' placeholder='Last Name' value = <?php echo $lastName; ?>>
            <input type = 'email' name ='email' placeholder='Email Address' value = <?php echo $email; ?>>

            <div class='message'><?php echo $detailsMessage; ?></div>

            <input type = 'submit' name ='saveDetails' value = 'SAVE'>

        </form>
    </div>

    <div class='formSection'>
        <form method='POST'>
            <h2>Password Update</h2>
            <input type = 'password' name ='oldPassword' placeholder='Old Password'>
            <input type = 'password' name ='newPassword' placeholder='New Password'>
            <input type = 'password' name ='newPassword2' placeholder='Confirm Password'>

            <div class='message'><?php echo $passwordMessage; ?></div>

            <input type = 'submit' name ='savePassword' value = 'SAVE'>

        </form>
    </div>
</div>



