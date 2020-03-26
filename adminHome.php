<?php
session_start();
if (!isset($_SESSION["isAdmin"])) {
    header("location: admin.php");
}
$_SESSION["adminHome"] = true;
require_once 'header.php';
require_once 'admin/adminNav.php';
?>




<section id="adminHome">
    <h1>WELCOME <?php echo (substr(strtoupper($_SESSION["isAdmin"]), 0, 10)); ?></h1>
    <a href="addMovie.php" class="btn btn-primary text-light ">ADD MOVIE</a>
</section>











<?php
unset($_SESSION["adminHome"]);
require_once 'admin/adminFooter.php';
require_once 'last.php';