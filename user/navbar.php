<nav class="navbar navbar-expand-sm fixed-top  navbar-dark  <?php if (isset($_SESSION["moviesPage"])) {
                                                                echo ("bg-movies");
                                                            } elseif (isset($_SESSION["contactsPage"])) {
                                                                echo ("bg-primary");
                                                            } elseif (isset($_SESSION["indexPage"])) {
                                                                echo ("bg-nav");
                                                            } ?>">
    <a class="navbar-brand" href="index.php">EM</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"
            aria-hidden="true"></i></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item <?php if (isset($_SESSION["indexPage"])) {
                                    echo ("active");
                                } ?>">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (isset($_SESSION["moviesPage"])) {
                                    echo ("active");
                                } ?>">
                <a class="nav-link" href="movies.php">Movies</a>
            </li>
            <li class="nav-item <?php if (isset($_SESSION["contactsPage"])) {
                                    echo ("active");
                                } ?>">
                <a class="nav-link" href="contacts.php">Contact</a>
            </li>
        </ul>
    </div>
</nav>
<div style="height: 45px;background-color:transparent"></div>