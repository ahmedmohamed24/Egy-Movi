<?php
session_start();
session_unset();
$userPhoneNum = htmlspecialchars($_POST["userNumber"]);
$userMSG = htmlspecialchars($_POST["userMessage"]);
$userMail = htmlspecialchars($_POST["userMail"]);
$userName = htmlspecialchars($_POST["userName"]);
require_once 'modals/validators.php';
$name = new NameValidator($userName);
$nameValidator = $name->validate();
$mail = new EmailValidator($userMail);
$emailValidator = $mail->validate();
$phone = new PhoneValidator($userPhoneNum);
$phoneValidator = $phone->validate();
$msg = new MsgValidator($userMSG);
$msgValidator = $msg->validate();

if ($nameValidator !== "true") {
    $_SESSION["userName"] = $nameValidator;
    header('location: contacts.php');
} elseif ($emailValidator !== "true") {
    $_SESSION["userNameValue"] = $userName;
    $_SESSION["userMail"] = $emailValidator;
    header('location: contacts.php');
} elseif ($phoneValidator !== "true") {
    $_SESSION["userNameValue"] = $userName;
    $_SESSION["userMailValue"] = $userMail;
    $_SESSION["userPhone"] = $phoneValidator;
    header('location: contacts.php');
} elseif ($msgValidator !== "true") {
    $_SESSION["userNameValue"] = $userName;
    $_SESSION["userMailValue"] = $userMail;
    $_SESSION["userPhoneValue"] = $userPhoneNum;
    $_SESSION["userMsg"] = $msgValidator;
    header('location: contacts.php');
} else {
    require_once 'DB/connection.php';
    $conn = new dbConnection();
    $insertCommand = "INSERT INTO messages(phone,message,email,name) VALUES ( $userPhoneNum ,'$userMSG','$userMail','$userName')";
    if ($conn->inserting($insertCommand)) {
        $_SESSION['inserted'] = "done";
        $conn->deConnect();
        header("location: index.php");
    } else {
        echo ($conn->inserting($insertCommand));
        $conn->deConnect();
    }
}