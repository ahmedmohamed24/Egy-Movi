<?php
session_start();
if (!isset($_SESSION["isAdmin"])) {
    header("location: admin.php");
}
require_once 'modals/validators.php';

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
    header("location:addMovie.php");
} elseif ($descValidateResult !== "true") //not valid Description 
{
    $_SESSION["titleValue"] = $movieTitle;
    $_SESSION["descError"] = $descValidateResult;
    header("location:addMovie.php");
} elseif ($imgNewName === "null") //no selected Image
{
    $_SESSION["titleValue"] = $movieTitle;
    $_SESSION["descValue"] = $desc;
    $_SESSION["imgError"] = "Choose Image Please";
    header("location:addMovie.php");
} else { //insert to database
    require_once 'DB/connection.php';
    $conn = new dbConnection();
    $insertCmd = "Insert INTO movies(img,title,description) VALUES('images/" . $imgNewName . "','$movieTitle','$desc')";
    $isInserted = $conn->inserting($insertCmd);
    $conn->deConnect();
    if ($isInserted) {
        $_SESSION["isInserted"] = true;
        unset($_SESSION["titleValue"]);
        unset($_SESSION["descValue"]);
        header("location:addMovie.php");
    }
    echo ($isInserted);
}