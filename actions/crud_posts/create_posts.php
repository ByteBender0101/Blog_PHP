<?php 
require_once __DIR__ . '/../../src/function.php';


$title = $_POST['title'];
$content = $_POST['content'];
$userId = currentUser()['id'];  

if (createPost($title, $content, $userId)) {
    setMessage('success', 'Post created successfully');
    redirect('/../../views/admin/dashboard.php');
} else {
    setMessage('error', 'Failed to create post');
    redirect('/../../views/admin/dashboard.php');
}

function createPost(string $title, string $content, int $userId): bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id) VALUES (:title, :content, :user_id)");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    return $stmt->execute();
}