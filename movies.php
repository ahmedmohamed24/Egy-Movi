<?php
session_start();
if (isset($_SESSION["isUpdated"])) {
    echo ('<script>document.addEventListener("DOMContentLoaded", () => {
        swal("Updated!", "You updated the movie!", "success");
    })</script>');
    unset($_SESSION["isUpdated"]);
}
if (isset($_SESSION["isDeleted"])) {
    echo ('<script>document.addEventListener("DOMContentLoaded", () => {
        swal("Deleted!", "You deleted the movie!", "success");
    })</script>');
    unset($_SESSION["isDeleted"]);
}
require_once 'header.php';

$_SESSION["moviesPage"] = true;
if (isset($_SESSION["isAdmin"])) {
    require_once 'admin/adminNav.php';
} else {
    require_once 'user/navbar.php';
}


require_once 'DB/connection.php';


$queryCmd = "SELECT COUNT('id') as moviesNumber FROM movies";
$newConnection = new dbConnection();
$filmsNumQuery = $newConnection->connect($queryCmd);
$filmsNum = mysqli_fetch_assoc($filmsNumQuery)["moviesNumber"];
$pagesNumber = ceil($filmsNum / 20);
if (isset($_GET["pageNum"])) {
    $currentPageNumber = htmlspecialchars($_GET["pageNum"]);
    if ($currentPageNumber > $pagesNumber || $currentPageNumber < 1)
        $pageNum = 1;
    else
        $pageNum = $currentPageNumber;
} else {
    $pageNum = 1;
}
$offset = 20 * ($pageNum - 1);
$queryCommand = "SELECT id,title,description AS overview,img AS imgSrc FROM movies LIMIT 20 OFFSET $offset ";
$res = $newConnection->connect($queryCommand);
if ($res === NULL) {
    echo ("<img src='images/error.jpg' alt='not found' class='w-100 min-height-100'/>");
} else {
?>

<div class=" p-5 moviesContainer">
    <div class="row ">
        <?php
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
        <div class=" col-md-6  ">
            <div class="movie mb-3">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="moviePoster">
                            <img src='<?php echo ($row['imgSrc']); ?>' class="" alt="<?php echo ($row['title']); ?>" />

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="movieDesc">
                            <h2><?php echo (substr($row['title'], 0, 50)); ?></h2>
                            <p><?php echo (substr($row['overview'], 0, 150) . "......."); ?></p>
                        </div>
                    </div>
                </div>

                <?php
                        if (isset($_SESSION["isAdmin"])) {
                            echo ("<div class='ml-4 my-2'>
                                        <a href='updateMovie.php?movieId=" . $row['id'] . "&pageNum=" . $pageNum . "' class='btn btn-warning'>Update</a>
                                        <a href='deleteMovie.php?movieId=" . $row['id'] . "&pageNum=" . $pageNum . "' class='btn text-light btn-danger'>Delete</a>
                                    </div>");
                        } else {
                            echo ("<div class='ml-4 my-2'>
                                        <a href='ViewMovie.php?movieId=" . $row['id'] . "&pageNum=" . $pageNum . "' class='btn btn-warning text-light'>View Movie</a>
                                    </div>");
                        }
                        ?>
            </div>
        </div>
        <?php
            } ?>

    </div>
</div>

<nav aria-label="Page navigation example "
    class="paginationContainer text-light text-center d-flex justify-content-center align-items-center">


    <ul class="pagination ">
        <li class="page-item">
            <a <?php if ($pageNum > 1) echo ("href='?pageNum=" . ($pageNum - 1) . "'");
                    ?> class="page-link text-primary">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#"><?php echo ($pageNum) ?></a></li>
        <li class="page-item">
            <a class="page-link text-primary"
                <?php if ($pageNum < $pagesNumber) echo ("href='?pageNum=" . ($pageNum + 1) . "'"); ?>>Next
            </a>
        </li>
    </ul>


</nav>
<?php

}
$newConnection->deConnect();
require_once 'user/footer.php';
unset($_SESSION["moviesPage"]);
require_once 'last.php';