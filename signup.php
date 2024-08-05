<?php
require_once __DIR__ . '/src/function.php';

checkGuest();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Signin Template · Bootstrap v5.0</title>
  <link href="assets/css/styles.css" rel="stylesheet" />
  <link href="assets/css/signin.css" rel="stylesheet" />


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
        <input type="email" class="form-control" id="email" placeholder="name@example.com" value="<?php echo old('email') ?>" <?php echo validationErrorAttr('email'); ?>>
        <?php if (hasValidationError('email')) : ?>
          <small><?php echo getValidationError('email'); ?></small>
        <?php endif; ?>
        <label for="floatingInput">Email address</label>
      </div>

      <div class="form-floating">
        <input type="name" class="form-control" id="username" placeholder="username" value="<?php echo old('name') ?>" <?php echo validationErrorAttr('name'); ?>>
        <?php if (hasValidationError('name')) : ?>
          <small><?php echo getValidationError('name'); ?></small>
        <?php endif; ?>
        <label for="floatingInput">Username</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Password" <?php echo validationErrorAttr('password'); ?>>
        <?php if (hasValidationError('password')) : ?>
          <small><?php echo getValidationError('password'); ?></small>
        <?php endif; ?>
        <label for="floatingPassword">Password</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="password_confirmation" placeholder="Password confirmation">
        <label for="floatingPassword">Password confirmation</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
    </form>
  </main>



</body>

</html>