<?php
session_start();
session_unset();
require_once 'modals/validators.php';
$adminMail = htmlspecialchars($_POST["adminMail"]);
$adminPassword = htmlspecialchars($_POST["adminPass"]);
$email = new EmailValidator($adminMail);
$emailValidator = $email->validate();
$pass = new PasswordValidator($adminPassword);
$passValidator = $pass->validate();

if ($emailValidator !== "true") {
    $_SESSION["adminMailError"] = $emailValidator;
    header("location:admin.php");
} elseif ($passValidator !== "true") {
    $_SESSION["adminMail"] = $adminMail;
    $_SESSION["adminPassError"] = $passValidator;
    header("location:admin.php");
} else {
    require_once 'DB/connection.php';
    $conn = new dbConnection();
    $queryCommand = 'SELECT * FROM admins WHERE email="' . $adminMail . '" and PASSWORD="' . $adminPassword . '"';
    $rows = $conn->connect($queryCommand);

    if ($rows === NULL) {
        $_SESSION["notAdmin"] = true;
        $conn->deConnect();
        header("location: admin.php");
    } else {
        $row = mysqli_fetch_assoc($rows);
        $_SESSION["isAdmin"] = $row["adminName"];
        $conn->deConnect();
        header("location:adminHome.php");
    }
}