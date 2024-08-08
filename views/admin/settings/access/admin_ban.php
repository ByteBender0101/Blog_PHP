<?php
require_once __DIR__ . '/../../../../src/function.php';
$user = currentUser();

if (!$user || !$user['role'] === 'admin') {
    header("Location: /views/admin/dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ban'])) {
        $userId = $_POST['user_id'];
        $reason = $_POST['reason']; // Ваша форма должна иметь поле для ввода причины
        if (banUser($userId, $reason)) {
            setMessage('success', 'Пользователь забанен успешно.');
        } else {
            setMessage('error', 'Не удалось забанить пользователя.');
        }
    }

    if (isset($_POST['unban'])) {
        $userId = $_POST['user_id'];
        if (unbanUser($userId)) {
            setMessage('success', 'Пользователь разбанен успешно.');
        } else {
            setMessage('error', 'Не удалось разбанить пользователя.');
        }
    }

    redirect('/views/admin/dashboard.php');
}