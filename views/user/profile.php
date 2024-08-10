<?php
require_once __DIR__ . '/../../src/function.php';

$user = currentUser();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once __DIR__ . '/../../components/header.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile picture -->
                <div class="text-center">
                    <img src="../../<?php echo $user['avatar']?>" class="rounded-circle img-thumbnail" style="width: 250px; height: 250px" alt="Avatar">
                </div>
                <form action="/actions/uploadImageAvatar.php" method="POST" enctype="multipart/form-data">
                    <input type="file" class="form-control form-control-sm my-3" name="avatar" id="avatar" />
                    <button class="btn btn-primary">Добавть фото</button>
                </form>
            </div>
            <div class="col-md-8">
                <!-- Profile details -->
                <h2>Профиль пользователя</h2>
                <p><strong>Имя:</strong> <?php echo $user['name'] ?></p>
                <p><strong>Почта:</strong> <?php echo $user['email'] ?></p>
                <!-- <p><strong>Location:</strong> New York, USA</p>
      <p><strong>Bio:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra eros nec enim hendrerit, at vehicula augue tempus.</p>
      <p><strong>Interests:</strong> Travel, Photography, Coding</p> -->
                <!-- Add more profile details as needed -->
            </div>
        </div>
    </div>
</body>

</html>