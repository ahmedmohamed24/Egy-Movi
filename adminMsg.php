<?php
session_start();
if (!isset($_SESSION['isAdmin'])) {
    header("location: admin.php");
}
$_SESSION["adminMsg"] = true;
require_once 'header.php';
require_once 'admin/adminNav.php';
require_once 'DB/connection.php';

$conn = new dbConnection();
$queryCmd = "SELECT * FROM `messages` WHERE 1";
$res = $conn->connect($queryCmd);
if ($res === null) {
    echo ("<h1 class='my-5 text-center'>No Messages to View</h1>");
} else {
    echo ('
    <div class="tableContainer my-5 container">
    <table class="table ">
            <thead>
                <tr>
                    <th scope="col" class="text-primary">Name</th>
                    <th scope="col"class="text-primary">Email</th>
                    <th scope="col"class="text-primary">Message</th>
                    <th scope="col"class="text-primary">Phone</th>
                </tr>
            </thead>
            <tbody>');
    while ($row = mysqli_fetch_assoc($res)) {
        echo ('<tr>
                <td class="text-info w-25">' . $row["name"] . '</td>
                <td class="text-info  w-25">' . $row["email"] . '</td>
                <td class="text-warning w-25">' . $row["message"] . '</td>
                <td class="text-info w-25">0' . $row["phone"] . '</td>
            </tr>');
    }
    echo ('   </tbody>
        </table>
        </div>');
}
$conn->deConnect();
unset($_SESSION["adminMsg"]);
require_once 'admin/adminFooter.php';
require_once 'last.php';