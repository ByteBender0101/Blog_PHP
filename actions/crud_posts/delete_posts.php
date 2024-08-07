<?php
session_start();
require_once __DIR__ . '/../../src/function.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   
    if (!isset($_GET['id'])) {
        $_SESSION['error'] = 'Post ID is required.';
    } else {

        $postId = $_GET['id'];

        if (deletePost($postId)) {
            $_SESSION['success'] = 'Post deleted successfully.';
        } else {
            $_SESSION['error'] = 'Failed to delete post.';
        }
    }
} else {
    $_SESSION['error'] = 'Invalid request method.';
}

header('Location: /../../views/admin/dashboard.php');
exit();

function deletePost($postId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $postId, PDO::PARAM_INT);

    return $stmt->execute();
}
?>
