<?php
require_once __DIR__ . '/../../src/function.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog:: Signup</title>
    <link href="/../../assets/css/styles.css" rel="stylesheet" />
    <link href="/../../assets/css/signin.css" rel="stylesheet" />


</head>

<body class="text-center">

    <main class="form-signin">
        <form action="/actions/register.php" method="post" enctype="multipart/form-data">
            <?php if (hasMessage('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php getMessage('error') ?>
                </div>
            <?php endif; ?>
            <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
                <?php if (hasValidationError('email')) : ?>
                    <small><?php echo validationErrorMessage('email'); ?></small>
                <?php endif; ?>
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="name" name="name" placeholder="username">
                <?php if (hasValidationError('name')) : ?>
                    <small><?php echo validationErrorMessage('name'); ?></small>
                <?php endif; ?>
                <label for="floatingInput">Username</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <?php if (hasValidationError('password')) : ?>
                    <small><?php echo validationErrorMessage('password'); ?></small>
                <?php endif; ?>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation">
                <label for="floatingPassword">Password confirmation</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" id="submit" type="submit">Sign up</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
        </form>
    </main>

</body>

</html>