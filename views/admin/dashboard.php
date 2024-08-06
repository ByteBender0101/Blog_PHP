<?php
require_once __DIR__ . '/../../src/function.php';
$user = currentUser();
echo "Привет, " . $user['name'] . "<br>" . "Это админка!" . "<br>" . "<a href='/'>Назад</a>";
?>


