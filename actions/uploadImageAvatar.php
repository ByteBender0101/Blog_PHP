<?php

require_once __DIR__ . '/../src/function.php';

$userId = currentUser()['id']; 
$avatarPath = null;
$avatar = $_FILES['avatar'] ?? null;

if (!empty($avatar)) {
    $types = ['image/jpeg', 'image/png'];

    if (!in_array($avatar['type'], $types)) {
        setValidationError('avatar', 'Изображение профиля имеет неверный тип');
    }

    if (($avatar['size'] / 1000000) >= 1) {
        setValidationError('avatar', 'Изображение должно быть меньше 1 мб');
    }
}

if (!empty($avatar)) {
    $avatarPath = uploadFile($avatar, 'avatar');
}

$pdo = getPDO();

$query = "UPDATE users SET avatar = :avatar WHERE id = :id";

$params = [
    'id' => $userId,
    'avatar' => $avatarPath
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('/views/user/profile.php');