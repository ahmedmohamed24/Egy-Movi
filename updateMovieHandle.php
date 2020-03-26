<?php
session_start();
if (!isset($_SESSION['isAdmin'])) {
    header("location: admin.php");
}
require_once 'modals/validators.php';
$movieId = $_GET["movieId"];
$pageNum = $_GET["pageNum"];
//title validation
$movieTitle = htmlspecialchars($_POST["movieTitle"]);
$titleValidateObject = new MovieTitle($movieTitle);
$titleValidateResult = $titleValidateObject->validate();

//description Validation
$desc = htmlspecialchars($_POST["movieDesc"]);
$descValidateObject = new MovieDesc($desc);
$descValidateResult = $descValidateObject->validate();

//image Validation
$img = $_FILES["movieImage"];
$uploadingValidateObject = new MovieImg($img);
$imgNewName = $uploadingValidateObject->upload();



/*check validation of the 3 inputs */
if ($titleValidateResult !== "true") //not valid Title
{
    $_SESSION["titleError"] = $titleValidateResult;
    header("location:updateMovie.php?movieId=$movieId&pageNum=$pageNum");
} elseif ($descValidateResult !== "true") //not valid Description 
{
    $_SESSION["titleValue"] = $movieTitle;
    $_SESSION["descError"] = $descValidateResult;
    header("location:updateMovie.php?movieId=$movieId&pageNum=$pageNum");
} else { //insert to database
    require_once 'DB/connection.php';
    $conn = new dbConnection();
    if ($imgNewName === "null")
        $updateCmd = 'UPDATE movies SET title="' . $movieTitle . '",description="' . $desc . '" WHERE id="' . $movieId . '"';
    else
        $updateCmd = 'UPDATE movies SET title="' . $movieTitle . '",description="' . $desc . '",img="images/' . $imgNewName . '" WHERE id="' . $movieId . '"';

    $isUpdated = $conn->updating($updateCmd);
    if ($isUpdated) {
        $_SESSION["isUpdated"] = true;
        unset($_SESSION["titleValue"]);
        unset($_SESSION["descValue"]);
    }


    $conn->deConnect();
    if (isset($_GET["pageNum"]))
        header("location:movies.php?pageNum=" . $_GET['pageNum']);
    header("location:movies.php");
}