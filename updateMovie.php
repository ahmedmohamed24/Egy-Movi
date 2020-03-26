<?php
session_start();
if (!isset($_SESSION['isAdmin'])) {
    header("location: admin.php");
}
if (!(isset($_GET['pageNum']) && isset($_GET['movieId']))) {
    header("location: movies.php");
}
$_SESSION["moviesPage"] = true;
require_once 'header.php';
require_once 'admin/adminNav.php';
require_once 'DB/connection.php';

$movieId = htmlspecialchars($_GET["movieId"]);
$pageNum = htmlspecialchars($_GET["pageNum"]);

$conn = new dbConnection();
$queryCmd = "SELECT * FROM movies WHERE id= '$movieId'";
$res = $conn->connect($queryCmd);
if ($res === null) {
    echo ("<img src='images/error.jpg' alt='not found' class='w-100 min-height-100'/>");
} else {
    $row = mysqli_fetch_assoc($res);
?>
<form action="updateMovieHandle.php?movieId=<?php echo ($movieId); ?>&pageNum=<?php echo ($pageNum); ?>"
    enctype="multipart/form-data" id="uploadingForm" method="POST" class="container my-5">
    <div class="form-group">
        <label for="mtitle" class="text-primary">TITLE</label>
        <input type="text" id="mtitle" name="movieTitle" class="form-control" value="<?php echo ($row['title']) ?>">
        <?php if (isset($_SESSION['titleError'])) echo ("<p class='alert alert-danger'>" . $_SESSION['titleError'] . "</p>"); ?>
    </div>
    <div class="form-group">
        <label for="mDesc" class="text-primary">DESCRIPTION</label>
        <input type="text" id="mDesc" name="movieDesc" class="form-control"
            value="<?php echo ($row["description"]); ?>">
        <?php if (isset($_SESSION['descError'])) echo ("<p class='alert alert-danger'>" . $_SESSION['descError'] . "</p>"); ?>

    </div>
    <div class="form-group">
        <img src="<?php echo ($row["img"]); ?>" class=" imgToUpdate" alt="<?php echo ($row["title"]); ?>">
        <div id="uploading" class="my-4">
            <input type="file" id="mName" name="movieImage" class="uploadingButton">
            <div class="uploadingView"><span><i class="fas fa-2x fa-upload"></i></span></div>
        </div>
        <?php if (isset($_SESSION['imgError'])) echo ("<p class='alert alert-danger'>" . $_SESSION['imgError'] . "</p>"); ?>

    </div>
    <button type="submit" class="btn btn-warning text-light">Update</button>
</form>
<?php
}
$conn->deConnect();
unset($_SESSION["titleError"]);
unset($_SESSION["descError"]);
unset($_SESSION["imgError"]);
unset($_SESSION["moviesPage"]);
require_once 'admin/adminFooter.php';
require_once 'last.php';