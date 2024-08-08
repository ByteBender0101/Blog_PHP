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
    <title>Blog:: Banned</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (isSetAuthentication()) : ?>
                <div class="ms-auto text-end">
                    <button type="button" class="btn btn-warning"><a href="/actions/logout.php" style="text-decoration: none; color: white;">Logout</a></button>
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