<?php

require_once __DIR__ . '/src/function.php';

$user = currentUser();
$isAdmin = isAdmin();
require_once __DIR__ . '/components/header.php';
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Blog</a></li>
                </ul>
                <?php if (isSetAuthentication()) : ?>
                    <div class="ms-auto text-end">
                        <?php if ($isAdmin) : ?>
                            <button type="button" class="btn btn-danger me-2"><a href="views/admin/dashboard.php" style="text-decoration: none; color: white;">Панель управления</a></button>
                        <? endif; ?>
                        <button type="button" class="btn btn-outline-success me-2"><a href="#" style="text-decoration: none; color: green;"><?php echo $user['name'] ?></a></button>
                        <button type="button" class="btn btn-warning"><a href="/actions/logout.php" style="text-decoration: none; color: white;">Logout</a></button>
                    </div>
                <? else : ?>
                    <div class="ms-auto text-end">
                        <button type="button" class="btn btn-outline-success me-2"><a href="views/authorization/signin.php" style="text-decoration: none; color: green;">Sign in</a></button>
                        <button type="button" class="btn btn-warning"><a href="views/authorization/signup.php" style="text-decoration: none; color: white;">Sign up</a></button>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <?php require_once __DIR__ . '/components/posts.php' ?>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                    <li class="page-item"><a class="page-link" href="#!">2</a></li>
                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                    <li class="page-item"><a class="page-link" href="#!">15</a></li>
                    <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                </ul>
            </nav>
        </div>
        <!-- Side widgets-->
        <?php
        require_once __DIR__ . '/components/search.php'
        ?>
        <!-- Categories widget-->
        <?php require_once __DIR__ . '/components/categories.php' ?>
        <!-- Side widget-->
        <div class="card mb-4">
            <div class="card-header">Side Widget</div>
            <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and
                feature the Bootstrap 5 card component!
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php require_once __DIR__ . '/components/footer.php' ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/scripts.js"></script>
</body>

</html>