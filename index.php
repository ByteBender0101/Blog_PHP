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

                <!-- Posts -->
                <?php require_once __DIR__ . '/components/posts.php' ?>

                <!-- Search -->
                <?php
                require_once __DIR__ . '/components/search.php'
                ?>

                <!-- Categories widget-->
                <?php require_once __DIR__ . '/components/categories.php' ?>
            </div>
            <?php require_once __DIR__ . '/components/pagination.php' ?>
        </div>
        </div>
        </div>
        <?php require_once __DIR__ . '/components/footer.php' ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                var $result = $('#search_box-result');

                $('#search').on('keyup', function() {
                    var search = $(this).val();
                    if ((search != '') && (search.length > 1)) {
                        $.ajax({
                            type: "POST",
                            url: "/actions/search.php",
                            data: {
                                'search': search
                            },
                            success: function(msg) {
                                $result.html(msg);
                                if (msg != '') {
                                    $result.fadeIn();
                                } else {
                                    $result.fadeOut(100);
                                }
                            }
                        });
                    } else {
                        $result.html('');
                        $result.fadeOut(100);
                    }
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.input-group').length) {
                        $result.html('');
                        $result.fadeOut(100);
                    }
                });

                $(document).on('click', '.search_result-name a', function() {
                    $('#search').val($(this).text());
                    $result.fadeOut(100);
                    return false;
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.input-group').length) {
                        $result.html('');
                        $result.fadeOut(100);
                    }
                });

            });
        </script>

    <?php endif; ?>
</body>

</html>