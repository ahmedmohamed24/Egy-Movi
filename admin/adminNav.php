<nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-primary fixed-top">
    <a class="navbar-brand" href="adminHome.php">EM</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"><span><i
                class="fa fa-bars" aria-hidden="true"></i></span></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item <?php if (isset($_SESSION["adminHome"])) echo ("active"); ?>">
                <a class="nav-link" href="adminHome.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (isset($_SESSION["moviesPage"])) echo ("active"); ?>">
                <a class="nav-link" href="movies.php">Movies</a>
            </li>
            <li class="nav-item <?php if (isset($_SESSION["adminMsg"])) echo ("active"); ?>">
                <a class="nav-link" href="adminMsg.php">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adminLogout.php">Log out</a>
            </li>
        </ul>
    </div>
</nav>
<div style="height: 45px;background-color:transparent"></div>