<?php
require_once __DIR__ . '/src/function.php';
$user = currentUser();
$banReason = getBanReason();
?>

<body>
    <?php if (isBanned()) : ?>
        <?php require_once __DIR__ . '/components/header_banned.php'; ?>
            <?php echo '
                    <div class="container my-3 alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Ваш аккаунт заблокирован.</strong> Пожалуйста, свяжитесь с администратором.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    '; ?>
    <?php else : ?>
        <?php require_once __DIR__ . '/components/header.php'; ?>
         <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <?php require_once __DIR__ . '/components/posts.php' ?>
                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                aria-disabled="true">Newer</a></li>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    <?php endif; ?>
</body>

</html>