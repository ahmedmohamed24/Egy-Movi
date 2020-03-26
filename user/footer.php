<footer class="py-5 text-light text-center   <?php if (isset($_SESSION["moviesPage"])) {
                                                    echo ("bg-movies");
                                                } elseif (isset($_SESSION["contactsPage"])) {
                                                    echo ("bg-primary");
                                                } elseif (isset($_SESSION["indexPage"])) {
                                                    echo ("bg-nav");
                                                } ?>">

    All copyrights reserved @2020 :EgyMovies.com
</footer>