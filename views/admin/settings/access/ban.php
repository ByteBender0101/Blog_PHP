<?php
require_once __DIR__ . '/../../../../src/function.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE users SET banned = 1 WHERE id = ?");
        $stmt->execute([$userId]);
        header("Location: /views/admin/dashboard.php"); // Перенаправление на страницу администратора
        exit();
    } catch (PDOException $e) {
        echo "Ошибка при бане пользователя: " . $e->getMessage();
    }
} else {
    echo "Неверный запрос.";
}
