<?php
session_start();
$_SESSION["contactsPage"] = "true";
require_once 'header.php';
require_once 'user/navbar.php';

?>

<form action="contactsHandle.php" method="POST" class="my-5 contacts container">
    <div class="form-group">
        <label for="uName" class="text-primary">Name</label>
        <input type="text" id="uName" name="userName" class="form-control"
            value="<?php if (isset($_SESSION['userNameValue'])) echo ($_SESSION['userNameValue']); ?>">
        <?php if (isset($_SESSION["userName"])) echo ("<p class='alert alert-danger'>" . $_SESSION['userName'] . "</p>"); ?>
    </div>
    <div class="form-group">
        <label for="uMail" class="text-primary">Email</label>
        <input type="text" id="uMail" name="userMail" class="form-control"
            value="<?php if (isset($_SESSION['userMailValue'])) echo ($_SESSION['userMailValue']); ?>">
        <?php if (isset($_SESSION["userMail"])) echo ("<p class='alert alert-danger'>" . $_SESSION['userMail'] . "</p>"); ?>
    </div>
    <div class="form-group">
        <label for="uPhone" class="text-primary">Phone Number</label>
        <input type="text" id="uPhone" name="userNumber" class="form-control"
            value="<?php if (isset($_SESSION['userPhoneValue'])) echo ($_SESSION['userPhoneValue']); ?>">
        <?php if (isset($_SESSION["userPhone"])) echo ("<p class='alert alert-danger'>" . $_SESSION['userPhone'] . "</p>"); ?>
    </div>
    <div class="form-group">
        <label for="uMsg" class="text-primary">Message</label>
        <textarea name="userMessage" id="uMsg" cols="30" rows="3" class="form-control"></textarea>
        <?php if (isset($_SESSION["userMsg"])) echo ("<p class='alert alert-danger'>" . $_SESSION['userMsg'] . "</p>"); ?>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>
<?php

require_once 'user/footer.php';
unset($_SESSION["contactsPage"]);


unset($_SESSION['userNameValue']);
unset($_SESSION["userName"]);
unset($_SESSION['userMailValue']);
unset($_SESSION["userMail"]);
unset($_SESSION['userPhoneValue']);
unset($_SESSION["userPhone"]);
unset($_SESSION["userMsg"]);
require_once 'last.php';