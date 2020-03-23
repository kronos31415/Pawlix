<?php
    require_once("includes/header.php");

    if(isset($_POST['saveDetails'])) {
        $account = new Account($conn);

        $firstName = FormSanitazer::sanitazeString($_POST['firstName']);
        $lastName = FormSanitazer::sanitazeString($_POST['lastName']);
        $email = FormSanitazer::sanitazeString($_POST['email']);

        $account->updateProfile($firstName, $lastName, $email, $userLoggedIn);

    }

?>

<div class='settingsContainer column'>
    <div class='formSection'>
        <form metod='POST'>
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

            <input type = 'submit' name ='saveDetails' value = 'SAVE'>

        </form>
    </div>

    <div class='formSection'>
        <form metod='POST'>
            <h2>Password Update</h2>
            <input type = 'password' name ='oldPassword' placeholder='Old Password'>
            <input type = 'password' name ='newPassword' placeholder='New PAssword'>
            <input type = 'password' name ='newPassword1' placeholder='Confirm Password'>

            <input type = 'submit' name ='savePassword' value = 'SAVE'>

        </form>
    </div>
</div>



