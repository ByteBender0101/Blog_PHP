<?php

// Старт сессии для использования суперглобального массива $_SESSION
session_start();

// Подключение конфигурационного файла с настройками базы данных
require_once __DIR__ . '/../config/database.php';

/**
 * Функция для перенаправления пользователя на другой URL и завершения выполнения скрипта.
 *
 * @param string $path Путь для перенаправления.
 */
function redirect(string $path)
{
    header("Location: $path");
    die();
}

/**
 * Устанавливает сообщение об ошибке валидации для конкретного поля в сессии.
 *
 * @param string $fieldName Имя поля, для которого устанавливается ошибка.
 * @param string $message Сообщение об ошибке.
 */
function setValidationError(string $fieldName, string $message): void
{
    $_SESSION['validation'][$fieldName] = $message;
}

/**
 * Проверяет, установлено ли сообщение об ошибке валидации для конкретного поля.
 *
 * @param string $fieldName Имя поля для проверки.
 * @return bool True, если ошибка существует, иначе false.
 */
function hasValidationError(string $fieldName): bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

/**
 * Возвращает атрибут 'aria-invalid="true"' для поля, если для него установлена ошибка.
 *
 * @param string $fieldName Имя поля для проверки.
 * @return string Атрибут 'aria-invalid', если ошибка существует, иначе пустая строка.
 */
function validationErrorAttr(string $fieldName): string
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

/**
 * Возвращает сообщение об ошибке для поля и удаляет его из сессии.
 *
 * @param string $fieldName Имя поля.
 * @return string Сообщение об ошибке.
 */
function validationErrorMessage(string $fieldName): string
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}

/**
 * Сохраняет старое значение поля в сессию (например, чтобы восстановить значение в случае ошибки).
 *
 * @param string $key Имя поля.
 * @param mixed $value Значение поля.
 */
function setOldValue(string $key, mixed $value): void
{
    $_SESSION['old'][$key] = $value;
}

/**
 * Возвращает старое значение поля из сессии и удаляет его.
 *
 * @param string $key Имя поля.
 * @return mixed Старое значение поля.
 */
function old(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

/**
 * Устанавливает произвольное сообщение в сессию (например, сообщение об успехе или ошибке).
 *
 * @param string $key Ключ для сообщения.
 * @param string $message Сообщение.
 */
function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

/**
 * Проверяет, существует ли сообщение по указанному ключу.
 *
 * @param string $key Ключ для проверки.
 * @return bool True, если сообщение существует, иначе false.
 */
function hasMessage(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

/**
 * Возвращает сообщение из сессии по ключу и удаляет его.
 *
 * @param string $key Ключ сообщения.
 * @return string Сообщение.
 */
function getMessage(string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

/**
 * Создает и возвращает объект PDO для подключения к базе данных.
 *
 * @return PDO Объект PDO.
 */
function getPDO(): PDO
{
    try {
        return new \PDO('mysql:host=' . HOSTNAME . ';port=' . PORT . ';charset=utf8;dbname=' . DATABASE, USERNAME, PASSWORD);
    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}

/**
 * Ищет пользователя в базе данных по email.
 *
 * @param string $email Email пользователя.
 * @return array|bool Массив с данными пользователя или false, если пользователь не найден.
 */
function findUser(string $email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

/**
 * Возвращает данные текущего авторизованного пользователя из базы данных.
 *
 * @return array|false Массив с данными пользователя или false, если пользователь не авторизован.
 */
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

/**
 * Завершает сессию пользователя (logout) и перенаправляет его на главную страницу.
 */
function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('/');
}

/**
 * Проверяет, авторизован ли пользователь.
 *
 * @return bool True, если пользователь авторизован, иначе false.
 */
function isSetAuthentication(): bool
{
    return isset($_SESSION['user']['id']);
}

/**
 * Проверяет, является ли текущий пользователь администратором.
 *
 * @return bool True, если пользователь администратор, иначе false.
 */
function isAdmin(): bool
{
    $user = currentUser();
    return $user && $user['role'] === 'admin';
}

/**
 * Возвращает все записи (посты) из базы данных.
 *
 * @return array Массив с данными постов.
 */
function getPosts(): array
{
    $pdo = getPDO();

    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Возвращает данные поста по его ID.
 *
 * @param int $postId ID поста.
 * @return array|false Массив с данными поста или false, если пост не найден.
 */
function getPostById($postId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Возвращает всех пользователей из базы данных.
 *
 * @return array Массив с данными пользователей.
 */
function getUsers()
{
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Блокирует пользователя, устанавливая флаг "banned" в 1.
 *
 * @param int $userId ID пользователя.
 * @return bool True, если операция успешна, иначе false.
 */
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

/**
 * Разблокирует пользователя, устанавливая флаг "banned" в 0.
 *
 * @param int $userId ID пользователя.
 * @return bool True, если операция успешна, иначе false.
 */
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

/**
 * Проверяет, заблокирован ли текущий пользователь.
 *
 * @return bool True, если пользователь заблокирован, иначе false.
 */
function isBanned(): bool
{
    $user = currentUser();
    return $user && $user['banned'] == 1;
}

/**
 * Возвращает причину блокировки пользователя, если она установлена.
 *
 * @return string|null Причина блокировки или null, если причина не указана.
 */
function getBanReason(): ?string
{
    $user = currentUser();
    return isset($user['ban_reason']) ? $user['ban_reason'] : null;
}

function uploadFile(array $file, string $prefix = ''): string
{
    $uploadPath = __DIR__ . '/../views/user/uploads';

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = $prefix . '_' . time() . ".$ext";

    if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
        die('Ошибка при загрузке файла на сервер');
    }

    return "uploads/$fileName";
}

function getPostsPagination(int $page = 1, int $postsPerPage = 10): array
{
    // Получаем объект PDO
    $pdo = getPDO();

    // Рассчитываем OFFSET
    $offset = ($page - 1) * $postsPerPage;

    // Выполняем SQL-запрос с LIMIT и OFFSET для пагинации
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at ASC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $postsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Возвращаем массив записей
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalPosts(): int
{
    $pdo = getPDO();

    $stmt = $pdo->query("SELECT COUNT(*) FROM posts");
    return (int)$stmt->fetchColumn();
}