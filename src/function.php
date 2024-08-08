<?php

session_start();

require_once __DIR__ . '/../config/database.php';

function redirect(string $path)
{
    header("Location: $path");
    die();
}


function setValidationError(string $fieldName, string $message): void
{
    $_SESSION['validation'][$fieldName] = $message;
}

function hasValidationError(string $fieldName): bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

function validationErrorAttr(string $fieldName): string
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function validationErrorMessage(string $fieldName): string
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}

function setOldValue(string $key, mixed $value): void
{
    $_SESSION['old'][$key] = $value;
}

function old(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

function hasMessage(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

function getMessage(string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function getPDO(): PDO
{
    try {
        return new \PDO('mysql:host=' . HOSTNAME . ';port=' . PORT . ';charset=utf8;dbname=' . DATABASE, USERNAME, PASSWORD);
    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}

function findUser(string $email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}


function currentUser(): array|false
{
    $pdo = getPDO();

    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('/');
}

function isSetAuthentication(): bool
{
    return isset($_SESSION['user']['id']);
}

function isAdmin(): bool
{
    $user = currentUser();
    return $user && $user['role'] === 'admin';
}


function getPosts(): array
{
    $pdo = getPDO();

    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPostById($postId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUsers()
{
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function banUser($userId)
{
    $pdo = getPDO();
    try {
        $stmt = $pdo->prepare("UPDATE users SET banned = 1 WHERE id = ?");
        $stmt->execute([$userId]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function unbanUser($userId)
{
    $pdo = getPDO();
    try {
        $stmt = $pdo->prepare("UPDATE users SET banned = 0 WHERE id = ?");
        $stmt->execute([$userId]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function isBanned(): bool
{
    $user = currentUser();
    return $user && $user['banned'] == 1;
}

function getBanReason(): ?string
{
    $user = currentUser();
    return isset($user['ban_reason']) ? $user['ban_reason'] : null;
}