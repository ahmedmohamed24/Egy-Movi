<?php
require_once 'header.php';
session_start();
if (isset($_SESSION["notAdmin"]))
    echo ('<script>document.addEventListener("DOMContentLoaded", () => {
    swal("You are not an admin");
})</script>');
unset($_SESSION["notAdmin"]);
?>


<form class="my-5 container" method="POST" action="adminHandle.php">

    <div class="form-group">
        <label for="aMail" class="text-primary">Email</label>
        <input type="text" id="aMail" name="adminMail" class="form-control"
            value="<?php if (isset($_SESSION["adminMail"])) echo ($_SESSION["adminMail"]) ?>" />
        <?php
        if (isset($_SESSION["adminMailError"]))
            echo ("<p class='alert alert-danger'>" . $_SESSION["adminMailError"] . "</p>")
        ?>
    </div>
    <div class="form-group">
        <label for="aPass" class="text-primary">Password</label>
        <input type="password" id="aPass" name="adminPass" class="form-control" />
        <?php
        if (isset($_SESSION["adminPassError"]))
            echo ("<p class='alert alert-danger'>" . $_SESSION["adminPassError"] . "</p>")
        ?>
    </div>

    <button type="submit" class="btn btn-primary">Log In</button>

</form>



<?php
require_once 'last.php';