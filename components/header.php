<?php
require_once __DIR__ . '/../src/function.php';
$user = currentUser();
$isAdmin = isAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Blog:: Home</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Blog</a></li>
            </ul>
            <?php if (isSetAuthentication()) : ?>
                <div class="ms-auto text-end">
                    <?php if ($isAdmin) : ?>
                        <button type="button" class="btn btn-danger"><a href="/views/admin/dashboard.php" style="text-decoration: none; color: white;">Панель управления</a></button>
                    <? endif; ?>
                </div>
                <div class="dropdown">
                    <img src="/<?php echo $user['avatar'] ?>" class="rounded-circle border d-flex justify-content-center align-items-center dropdown-toggle mx-3" style="width: 40; height: 40px" alt="Avatar" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/views/user/profile.php" style="text-decoration: none; color: black;"><?php echo $user['name'] ?></a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/actions/logout.php" style="text-decoration: none; color: black;">Logout</a></li>
                    </ul>
                </div>
                <!-- <button type="button" class="btn btn-outline-success me-2"><a href="/views/user/profile.php" style="text-decoration: none; color: white;"><?php echo $user['name'] ?></a></button> -->
                <!-- <button type="button" class="btn btn-warning"><a href="/actions/logout.php" style="text-decoration: none; color: white;">Logout</a></button> -->
        </div>
    <? else : ?>
        <div class="ms-auto text-end">
            <button type="button" class="btn btn-outline-success me-2"><a href="views/authorization/signin.php" style="text-decoration: none; color: white;">Sign in</a></button>
            <button type="button" class="btn btn-warning"><a href="views/authorization/signup.php" style="text-decoration: none; color: white;">Sign up</a></button>
        </div>
    <? endif; ?>
    </div>
    </div>
</nav>