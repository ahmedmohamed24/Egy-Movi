<?php
session_start();
if (!isset($_SESSION["isAdmin"])) {
    header("location: admin.php");
}
$_SESSION["adminHome"] = true;
require_once 'header.php';
require_once 'admin/adminNav.php';
if (isset($_SESSION["isInserted"])) {
    echo ('<script>document.addEventListener("DOMContentLoaded", () => {
        swal("Added!", "You added the movie!", "success");
    })</script>');
}
?>



<form action="addMovieHandle.php" enctype="multipart/form-data" id="uploadingForm" method="POST" class="container my-5">
    <div class="form-group">
        <label for="mtitle" class="text-primary">TITLE</label>
        <input type="text" id="mtitle" name="movieTitle" class="form-control"
            value="<?php if (isset($_SESSION["titleValue"])) echo ($_SESSION["titleValue"]); ?>">
        <?php if (isset($_SESSION['titleError'])) echo ("<p class='alert alert-danger'>" . $_SESSION['titleError'] . "</p>"); ?>
    </div>
    <div class="form-group">
        <label for="mDesc" class="text-primary">DESCRIPTION</label>
        <input type="text" id="mDesc" name="movieDesc" class="form-control"
            value="<?php if (isset($_SESSION["descValue"])) echo ($_SESSION["descValue"]); ?>">
        <?php if (isset($_SESSION['descError'])) echo ("<p class='alert alert-danger'>" . $_SESSION['descError'] . "</p>"); ?>
    </div>
    <div class="form-group">
        <label for="mName" class="text-primary">IMAGE</label>
        <div id="uploading">
            <input type="file" id="mName" name="movieImage" class="uploadingButton">
            <div class="uploadingView"><span><i class="fas fa-2x fa-upload"></i></span></div>
        </div>
        <?php if (isset($_SESSION['imgError'])) echo ("<p class='alert alert-danger'>" . $_SESSION['imgError'] . "</p>"); ?>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>





<?php
unset($_SESSION["titleError"]);
unset($_SESSION["descError"]);
unset($_SESSION["imgError"]);
unset($_SESSION["adminHome"]);
require_once 'admin/adminFooter.php';
require_once 'last.php';