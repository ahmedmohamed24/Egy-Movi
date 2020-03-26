<?php
session_start();
$_SESSION["moviesPage"] = true;
if (!(isset($_GET['pageNum']) && isset($_GET['movieId']))) {
    header("location: movies.php");
}
require_once 'header.php';
require_once 'user/navbar.php';
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
    echo ('
    <div class="movieView">
    <div  class=" container py-5">
    <a href="movies.php?pageNum=' . $pageNum . '"><span class=""><i class="fa fa-2x fa-arrow-circle-left text-warning" aria-hidden="true"></i></span></a>

    <div class="row">
        <div class="col-md-6">
            <div class="filmOverview">
                <h1 class="filmTitle text-center">' . $row["title"] . '</h1>
                <p class="filmDescription">' . $row["description"] . '</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="filmPicture text-center">
                <img src="' . $row["img"] . '" alt="' . $row["title"] . '" class="img-fluid">
            </div>
        </div>
    </div>
    </div>
    <div class="text-center py-5 "><iframe class="videoIframe"  src="https://www.youtube.com/embed/I0h3onMey-4" frameborder="2px"
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>

</div>');
?>

<?php
}
$conn->deConnect();
require_once 'user/footer.php';
unset($_SESSION["moviesPage"]);
require_once 'last.php';