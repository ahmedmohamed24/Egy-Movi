<?php
session_start();
if (!isset($_SESSION['isAdmin'])) {
    header("location: admin.php");
}
$movieId = htmlspecialchars($_GET["movieId"]);
$pageNum = htmlspecialchars($_GET["pageNum"]);


require_once 'DB/connection.php';
$conn = new dbConnection();
$deleteCmd = "DELETE FROM movies WHERE id=$movieId";
$res = $conn->deleting($deleteCmd);
$conn->deConnect();
if ($res) {
    $_SESSION["isDeleted"] = true;
}
header("location:movies.php?movieId=$movieId&pageNum=$pageNum");